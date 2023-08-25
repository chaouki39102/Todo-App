<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetFileController extends Controller
{
    // function index(Request $request)
    // {
    //     return Storage::url($request->query('path'));
    // }
    function index(Request $request)
    {
        $path =$request->query('path');
        if (blank($path) || !Storage::exists($path)){
            abort(404);
        };
        return Storage::response($path);
    }
}
