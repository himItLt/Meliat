<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageInt;
use App\Gallery;
use Carbon\Carbon;

class FilesController extends Controller
{
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
        
        $basePath = $_SERVER['DOCUMENT_ROOT'];
        
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
            
            // $wt = Storage::disk('public')->get('/images/watermark.png');
            // $watermark = Image::make(public_path('/images/watermark.png'));
            // $img->insert($watermark, 'top-left');
            
            // Нарезаем изображения и раскладываем по папкам
            // $original = $img->save(substr($largeDir, 1) . '/' . $filename);
            
            // $or = Storage::disk('public')->get(substr($largeDir, 1) . '/' . $filename);
            // $wtImg = ImageInt::make($or);
            // $watermark = Image::make(torage::disk('public')->get('images/watermark.png'));
            // $wtImg->insert($watermark, 'top-left');
            // $wtImg->save(substr($largeDir, 1) . '/' . $filename);
            
            
            
            
            $img = ImageInt::make($image);
            $mediumImg = $img->fit(360, 252, function($img){
                $img->upsize();
            });
            $mediumImg->save(substr($mediumDir, 1) . '/' . $filename);
            
            $img = ImageInt::make($image);
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
    
    public function upd()
    {
        
        $items = Gallery::where([['resource_id', 9]])->get();
        $i = 1;
        foreach($items as $item) {
            $item->created_at = Carbon::now()->subMinutes($i++);
            $item->save();
        }
        // $date = Carbon::now();
        // $out = $date->subMinutes(10);
        return 'ok' ;
    }
    
    public function upload(Request $request)
    {
        $file = $_FILES['file']['name'];
        $path = $request->path;
        
        $request->file('file')->storeAs($path . '/', $file, 'public');
        
        return response([
                'file' => $file,
                'path' => $path
            ]);
    }
    
    
}
