<?php

namespace App\Http\Controllers\Backend;

use App\Chunk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChunkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.chunks.chunks', [
            'chunks' => Chunk::paginate(20),
            'title' => 'Chunks'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.chunks.create', [
            'title' => 'Новый чанк'
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
        Chunk::create($request->all());

        $data = ['msg' => 'Чанк успешно сохранен'];
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chunk  $chunk
     * @return \Illuminate\Http\Response
     */
    public function show(Chunk $chunk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chunk  $chunk
     * @return \Illuminate\Http\Response
     */
    public function edit(Chunk $chunk)
    {
        return view('dashboard.chunks.edit', [
            'chunk' => $chunk,
            'title' => 'Редактируем: ' . $chunk['title']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chunk  $chunk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chunk $chunk)
    {
        $chunk->update($request->all());

        $data = ['msg' => 'Чанк успешно сохранен'];
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chunk  $chunk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chunk $chunk)
    {
        //
    }
}
