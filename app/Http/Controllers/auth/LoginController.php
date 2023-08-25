<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{

  public function index()
  {
    $title = __('Login');
    return view('auth.login', compact('title'));
  }

  public function store(StoreLoginRequest $request)
  {
    $isLogin = Auth::attempt($request->only(['email', 'password'], $request->get('remember', false)));
    if ($isLogin) {
      Alert::success('Welcome Back!', 'You are Login successfully!');
      return to_route('task');
    } else {
      Alert::warning('Error!', 'User name or password is incorrect!');
      return Back();
    }
  }


  public function logout()
  {
    Auth::logout();
    return to_route('auth.login.index');
  }
}
