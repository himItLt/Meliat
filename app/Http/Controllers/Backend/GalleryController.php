<?php

namespace App\Http\Controllers\Backend;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageInt;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $fileinfo = pathinfo($request->file);
        $path = $fileinfo['dirname'];
        $filename = $fileinfo['basename'];
        
        // Прверяем есть ли такой файл в галереи
        $existFile = Gallery::where([
            ['filename', '=', $filename],
            ['resource_id', '=', $request->id]
        ])->get();
        if (count($existFile) > 0) {
            return response(['error' => 'Файл уже существует'], 410);
        }
        
        // Проверяем есть ли нужные директории в родительской
        
        $parentDir = Storage::disk('public')->directories($path);
        
        $largeDir = $path . '/watermark';
        $mediumDir = $path . '/preview/221x169';
        $smallDir = $path . '/thumbs/60x45';
        
        $watermark = 0;
        $thumb = 0;
        $preview = 0;
        
        
        if ($fileinfo['extension'] == 'gif') {
            if (array_search($smallDir, $parentDir) === false) {
                Storage::disk('public')->makeDirectory($smallDir);
            }
            $image = Storage::disk('public')->get($request->file);
            $img = ImageInt::make($image);
            $smallImg = $img->fit(92, 75, function($img){
                $img->upsize();
            });
            $smallImg->save(substr($smallDir, 1) . '/' . $filename);
            
        } else {
            if (array_search($largeDir, $parentDir) === false) {
                Storage::disk('public')->makeDirectory($largeDir);
            }
            if (array_search($mediumDir, $parentDir) === false) {
                Storage::disk('public')->makeDirectory($mediumDir);
            }
            if (array_search($smallDir, $parentDir) === false) {
                Storage::disk('public')->makeDirectory($smallDir);
            }
            
            
            // Берем указанное изображение
            $image = Storage::disk('public')->get($request->file);
            $img = ImageInt::make($image);
            
            $wtImg = ImageInt::make($image);
            $watermark = ImageInt::make(Storage::disk('public')->get('images/watermark.png'));
            $wtImg->insert($watermark, 'top-left', 10, 10);
            
            // Нарезаем изображения и раскладываем по папкам
            $original = $wtImg->save(substr($largeDir, 1) . '/' . $filename); 
            
            $mediumImg = $img->fit(360, 252, function($img){
                $img->upsize();
            });
            $mediumImg->save(substr($mediumDir, 1) . '/' . $filename);
            
            $smallImg = $img->fit(92, 75, function($img){
                $img->upsize();
            });
            $smallImg->save(substr($smallDir, 1) . '/' . $filename);
            
            $watermark = 1;
            $thumb = 1;
            $preview = 1;
            
        }
        
        $res = Gallery::create([
                    'resource_id' => $request->id,
                    'filename' => $filename,
                    'root_path' => $path . '/',
                    'watermark' => $watermark,
                    'thumb' => $thumb,
                    'preview' => $preview
                ]);
        
        $response = [
            'img' => $request->file,
            'file' => $filename,
            'id' => $res->id,
            'root_path' => $path . '/',
            'route' => '/ck5e974ldld5782pnbp5fh73hj5dk/gallery/' . $res->id
            ];
        
        return response(['response' => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return response()->json(['data'=> $gallery], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update($request->all());

        $data = ['msg' => 'Данные изображения успешно обновлены'];
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $largeDir = 'images/GallerySigPlus/Gallery-DE/watermark';
        $mediumDir = 'images/GallerySigPlus/Gallery-DE/preview/221x169';
        $smallDir = 'images/GallerySigPlus/Gallery-DE/thumbs/60x45';
        Storage::disk('public')->delete($largeDir . '/' . $gallery['filename']);
        Storage::disk('public')->delete($mediumDir . '/' . $gallery['filename']);
        Storage::disk('public')->delete($smallDir . '/' . $gallery['filename']);
        Storage::disk('public')->delete('images/GallerySigPlus/Gallery-DE' . '/' . $gallery['filename']);

        $gallery->delete();
        
        $data = ['msg' => 'Документ успешно удален'];
        return $data;
    }
}
