<?php

namespace App\Http\Controllers\Admin;




use App\Road;
use App\Size;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Http\Requests\MassDestroySizeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('size_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $size = Size::all();
        return view('admin.size.index', compact('size'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        abort_if(Gate::denies('size_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roads = road::all()->pluck('name', 'id');
        return view('admin.size.create', compact('roads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSizeRequest $request)
    {
        $size = Size::create($request->all());
        $size->roads()->sync($request->input('roads', []));
//        echo '<pre>';print_r($size);die();
        return redirect()->route('admin.sizes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        abort_if(Gate::denies('size_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roads = Road::all()->pluck('name', 'id');
        $size->load('roads');
//       echo '<pre>';print_r($roads);die;
        return view('admin.size.edit', compact('size','roads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        $size->update($request->all());
        $size->roads()->sync($request->input('roads', []));
//        echo '<pre>';print_r($size);die;
        return redirect()->route('admin.sizes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        abort_if(Gate::denies('size_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $size->load('roads');
        return view('admin.size.show', compact('size'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        abort_if(Gate::denies('size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        echo '<pre>';print_r($size);
        $size->delete();

        return back();
    }

    public function massDestroy(MassDestroySizeRequest $request)
    {
        Size::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
