<?php

namespace App\Http\Controllers\Backend;

use App\Resource;
use App\Chunk;
use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.resources.resources', [
            'resources' => Resource::where('parent_id', 0)->paginate(20),
            'title' => 'Страницы',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Resource::where([
            ['is_category', 1],
        ])->get();

        return view('dashboard.resources.create', [
            'title' => 'Новый документ',
            'chunks' => Chunk::all(),
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Resource::create($request->all());

        $data = ['msg' => 'Документ успешно сохранен'];
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        $categories = Resource::where([
            ['is_category', 1],
            ['id', '!=', $resource['id']]
        ])->get();
        $children = Resource::where('parent_id', $resource['id'])->paginate(20);
        return view('dashboard.resources.edit', [
            'resource' => $resource,
            'categories' => $categories,
            'children' => $children,
            'chunks' => Chunk::all(),
            'gallery' => Gallery::where('resource_id', '=', $resource['id'])->get(),
            'title' => 'Редактируем: ' . $resource['de_title']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $resource->update($request->all());

        $data = ['msg' => 'Документ успешно сохранен'];
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
        
        $data = ['msg' => 'Документ успешно удален'];
        return $data;
    }
}
