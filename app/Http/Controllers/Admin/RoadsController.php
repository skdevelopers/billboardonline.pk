<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoadRequest;
use App\Http\Requests\StoreRoadRequest;
use App\Http\Requests\UpdateRoadRequest;
use App\Road;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class RoadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        abort_if(Gate::denies('road_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $road = Road::all();
        return view('admin.roads.index', compact('road'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        abort_if(Gate::denies('road_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::all()->pluck('name', 'id');
        return view('admin.roads.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(StoreRoadRequest $request)
    {
        $road = Road::create($request->all());
        $road->categories()->sync($request->input('categories', []));
//        echo '<pre>';print_r($road);die();
        return redirect()->route('admin.roads.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Road  $road
     * @return Response
     */
    public function edit(Road $road)
    {
        abort_if(Gate::denies('road_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::all()->pluck('name', 'id');
        $road->load('categories');
//       echo '<pre>';print_r($categories);die;
        return view('admin.roads.edit', compact('road','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Road  $road
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoadRequest $request, Road $road)
    {
        $road->update($request->all());
        $road->categories()->sync($request->input('categories', []));
//        echo '<pre>';print_r($roads);die;
        return redirect()->route('admin.roads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Road  $road
     * @return Response
     */
    public function show(Road $road)
    {
        abort_if(Gate::denies('road_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $road->load('categories');
        return view('admin.roads.show', compact('road'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Road  $road
     * @return Response
     */
    public function destroy(Road $road)
    {
        abort_if(Gate::denies('road_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        echo '<pre>';print_r($roads);
        $road->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoadRequest $request)
    {
        Road::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
