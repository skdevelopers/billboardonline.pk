<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Day;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyShopRequest;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Road;
use App\Shop;
use App\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shops = Shop::all();

        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        abort_if(Gate::denies('shop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id');
        $roads = Road::all()->pluck('name', 'id');
        $sizes = Size::all()->pluck('name', 'id');

        $days = Day::all();
//        echo '<pre>';print_r($data);die;
        return view('admin.shops.create', compact('categories', 'roads','sizes','days'));
    }

    public function store(StoreShopRequest $request): RedirectResponse
    {
        $shop = Shop::create($request->all());

        $shop->categories()->sync($request->input('categories'));
        $shop->roads()->sync($request->input('roads'));
        $shop->sizes()->sync($request->input('sizes'));

        $hours = collect($request->input('from_hours'))->mapWithKeys(function($value, $id) use ($request) {
            return $value ? [
                    $id => [
                        'from_hours'    => $value,
                        'from_minutes'  => $request->input('from_minutes.'.$id),
                        'to_hours'      => $request->input('to_hours.'.$id),
                        'to_minutes'    => $request->input('to_minutes.'.$id)
                    ]
                ]
                : [];
        });
        $shop->days()->sync($hours);

        foreach ($request->input('photos', []) as $file) {
            $shop->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }
//        echo '<pre>';print_r($shop);die;
        return redirect()->route('admin.shops.index');
    }

    public function edit(Request $request, Shop $shop)
    {
        abort_if(Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id');
        $roads = Road::all()->pluck('name','id');
        $sizes = Size::all()->pluck('name','id');
        $days = Day::all();
        $data = $request->session()->all();
        $shop->load('categories', 'created_by', 'days');

        return view('admin.shops.edit', compact('categories', 'shop', 'days','roads','sizes','data'));
    }

    public function update(UpdateShopRequest $request, Shop $shop): RedirectResponse
    {
        if(!$request->active){
            $request->merge([
                'active' => 0
            ]);
        }
        if(!$request->featured){
            $request->merge([
                'featured' => 0
            ]);
        }
        $shop->update($request->all());
        $shop->categories()->sync($request->input('categories', []));
        $shop->roads()->sync($request->input('roads', []));
        $shop->sizes()->sync($request->input('sizes', []));
        $hours = collect($request->input('from_hours'))->mapWithKeys(function($value, $id) use ($request) {
            return $value ? [
                    $id => [
                        'from_hours'    => $value,
                        'from_minutes'  => $request->input('from_minutes.'.$id),
                        'to_hours'      => $request->input('to_hours.'.$id),
                        'to_minutes'    => $request->input('to_minutes.'.$id)
                    ]
                ]
                : [];
        });
        $shop->days()->sync($hours);

        if (count($shop->photos) > 0) {
            foreach ($shop->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $shop->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $shop->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }
//        return  redirect()->back()->with('IT WORKS! SK Developers.');
        return redirect()->route('admin.shops.index');
    }

    public function show(Shop $shop)
    {
        abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        echo '<pre>'; print_r($shop);die;
        $days = Day::all();
        $shop->load('categories', 'created_by');

        return view('admin.shops.show', compact('shop', 'days'));
    }

    public function destroy(Shop $shop)
    {
        abort_if(Gate::denies('shop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->delete();

        return back();
    }

    public function massDestroy(MassDestroyShopRequest $request)
    {
        Shop::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getRoad(Request $request,Road $road, Category $category): JsonResponse
    {
        $data   = $request->all();
        $id     =  $request->id ; //$request->input('categories', []);
        $data   = Road::with('categories:id,name')->pluck('name','id');
//        $data = Road::whereIn('id', function($query) use ($id) {
//            $query->select('category_id')->from('category_road')->whereCategorId($id);
//        })->pluck('name','id');
        return response()->json($data);
    }
}
