<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;

class ErrorController extends Controller
{
    public function notfound()
    {
        $locale = app()->getLocale();
        $menu = Resource::where([
                [$locale . '_published', '=', 1],
                [$locale . '_menushow', 1],
                ['parent_id', 0]
            ])->get();

        $footerMenu = Resource::where([
                [$locale . '_published', '=', 1],
                ['parent_id', 0]
            ])->get();
        
        return response(view('errors.404', [
            'menu' => $menu,
            'loc' => $locale,
            'footerMenu' => $footerMenu,
        ]), 404);
    }
}
