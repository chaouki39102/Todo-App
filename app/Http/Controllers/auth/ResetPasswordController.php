<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index()
    {
        $title = __('Reset Password');
        return view('front.auth.reset-password.index', compact('title'));
    }
}
