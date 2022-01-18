<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Post;
use App\Road;
use App\Shop;
use App\Size;
use App\Slider;
use App\User;
use App\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index(Slider  $slider)
    {
        $categories = Category::all();
        $roads      = Road::all();
        $sizes      = Size::all();
        $sliders    = Slider::all();
        $banners    = Banner::all();
        $videos     = Video::orderBy('updated_at', 'desc')->paginate(3);
        $posts      = Post::orderBy('updated_at', 'desc')->paginate(3);
        $logos      = User::pluck('logo');
        $shops      = Shop::with(['categories', 'days'])
            ->searchResults()
            ->paginate(15);
        $mapShops = $shops->makeHidden(['active', 'featured', 'created_at', 'updated_at', 'deleted_at', 'created_by_id', 'photos', 'media']);
        $latitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('latitude') : 30.3753;
        $longitude = $shops->count() && (request()->filled('category') || request()->filled('search')) ? $shops->average('longitude') : 69.3451;

        return view('home', compact('banners','categories','roads', 'shops', 'sliders', 'videos', 'posts','sizes', 'mapShops', 'latitude', 'longitude','logos'));
    }

    public function about()
    {
        $banners    = Banner::all();
        return view('about',compact('banners'));

    }

    public function blog()
    {
        $posts = Post::all(); //fetch all blog posts from DB
        $banners    = Banner::all();
        return view('blog', [
            'posts' => $posts,
            'banners' => $banners,
        ]); //returns the view with posts
    }
    public function Post(Post $post)
    {
//        dd($post);
        $post = Post::findOrFail($post->id);
//        dd($post);
//        return redirect()->route('posts.show', [$post]);
        return view('post', [
            'posts' => $post,
        ]); //returns the view with the post
    }
    public function contact()
    {
        return view('contact');

    }

    public function show(Shop $shop, User $user)
    {
//        echo '<pre>'; print_r($shop);die;
        $shop->load(['categories', 'days']);

        return view('shop', compact('shop'));
    }

    public function getRoad(Request $request,Road $road, Category $category): JsonResponse
    {
        $data   = $request->all();
        $id     =  $request->id ; //$request->input('categories', []);
//        $data = Road::where('category_id',$id)->pluck('name','id');
        $data = Road::whereIn('id', function($query) use ($id) {
            $query->select('road_id')->from('category_road')->whereCategoryId($id);
        })->pluck('name','id');
        return response()->json($data);
    }

    public function CityWithRoadID($id)
    {
        $road = Category::whereHas('roads', function ($query) use($id) {
            $query->where('id', $id);
        })->get();
        return response()->json($road);
    }
}
