<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chunk;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageInt;

class AjaxController extends Controller
{
    public function getChunkCode(Request $request, $id)
    {
        $chunkCode = Chunk::find($id);

        return response()->json(['data'=> $chunkCode['content']], 200);
    }

    public function getHomeDir()
    {

        $dirs = Storage::disk('public')->directories('/');
        $dirList = [];

        if (count($dirs) > 0) {
            foreach ($dirs as $dir) {
                if(glob($dir . '/*')) {
                    $dirList[] = ['dir' => $dir, 'status' => 1];
                } else {
                    $dirList[] = ['dir' => $dir, 'status' => 0];
                }
            }
        }

        $files = Storage::disk('public')->files('/');

        $fileList = [];
        foreach ($files as $file) {
            $filePart = explode('/', $file);
            $filename = array_pop($filePart);
            $fileList[] = [
                'filename' => $file,
                'file' => $file
            ];
        }
        return response()->json([
            'dirs' => $dirList,
            'files' => $fileList
        ], 200);
    }

    public function getDir($dir)
    {
        $dirRealPath = str_replace('_dir_', '/', $dir);

        $dirs = Storage::disk('public')->directories($dirRealPath);
        $files = Storage::disk('public')->files($dirRealPath);
        $dirList = [];

        if (count($dirs) > 0) {
            foreach ($dirs as $dir) {
                $dirPart = explode('/', $dir);
                $dirName = array_pop($dirPart);
                //$dirUrlPath = str_replace('/', '-', $dir);
                
                if(glob($dir . '/*')) {
                    $dirList[] = ['dir' => $dir, 'dirname' => $dirName, 'status' => 1];
                } else {
                    $dirList[] = ['dir' => $dir, 'dirname' => $dirName, 'status' => 0];
                }
            }
        }

        $fileList = [];
        if (count($files) > 0) {
            foreach ($files as $file) {
                $filePart = explode('/', $file);
                $filename = array_pop($filePart);
                $fileList[] = [
                    'filename' => $filename,
                    'file' => $file
                ];
            }
        }
        
        return response()->json([
            'dirs' => $dirList,
            'files' => $fileList
        ], 200);
    }

    public function test(Request $request)
    {
        $dirId = $request->input('id');
        $directories = Storage::disk('public')->directories('/');

        if (array_search($dirId, $directories) === false) {
            Storage::disk('public')->makeDirectory('images/resources/' . $dirId);
        }

        $parentDir = Storage::disk('public')->directories('images/resources/' . $dirId);
        $largeDir = 'images/resources/' . $dirId . '/large';
        $mediumDir = 'images/resources/' . $dirId . '/medium';
        $smallDir = 'images/resources/' . $dirId . '/small';


        if (array_search('large', $parentDir) === false) {
            Storage::disk('public')->makeDirectory($largeDir);
        }
        if (array_search('medium', $parentDir) === false) {
            Storage::disk('public')->makeDirectory($mediumDir);
        }
        if (array_search('small', $parentDir) === false) {
            Storage::disk('public')->makeDirectory($smallDir);
        }

        $image = $request->file('file');

        $filename = $_FILES['file']['name'];
        $img = ImageInt::make($image);

        // Large
        $largeImg = $img->fit(800,800, function($img){
            $img->upsize();
        });
        $largeImg->save($largeDir  . '/'. $filename);
        // Medium
        $mediumImg = $img->fit(400,400, function($img){
            $img->upsize();
        });
        $mediumImg->save($mediumDir  . '/'. $filename);
        // Small
        $smallImg = $img->fit(200,200, function($img){
            $img->upsize();
        });
        $smallImg->save($smallDir  . '/'. $filename);
        
        
        $path = $request->file('file')->storeAs('images/' . $dirId, $filename, 'public');
        //$request->file('file')->storeAs($largeDir, $filename, 'public');
        //$request->file('file')->storeAs($mediumDir, $filename, 'public');
        //$request->file('file')->storeAs($smallDir, $filename, 'public');
        //Storage::put('images/3/small/' . $filename,  $resizedImage);
        return 'ok';
        // print('<pre>');
        // print_r($directories = Storage::disk('public')->directories('/'));
    }
}
