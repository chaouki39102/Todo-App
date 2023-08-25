<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        $title = __('Register');
        return view('front.auth.register.index', compact('title'));
    }

    public function store(StoreRegisterRequest $request)
    {
        $data = $request->validated();
        //dd($data);
        $user = User::create($data);
        Auth::login($user);
        return to_route('home');
    }
}
