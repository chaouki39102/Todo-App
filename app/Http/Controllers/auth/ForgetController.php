<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgetController extends Controller
{
    public function index()
    {
        $title = __('Forget Password');
        return view('front.auth.forget.index', compact('title'));
    }
}
