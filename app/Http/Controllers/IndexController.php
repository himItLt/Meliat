<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;

class IndexController extends Controller
{
    public function index()
    {
        return redirect('/de');
    }

    public function sitemap()
    {
        $resources = Resource::where([
            ['de_published', 1],
            ['ru_published', 1],
        ])->get();

        $content = view('sitemap',['resources' => $resources]);
        return response($content)->header('Content-Type', 'text/xml;charset=utf-8');
    }
}
