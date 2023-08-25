<?php

use Illuminate\Support\Str;
use App\Enums\UserTypeEnum;

if (!function_exists('setting')) {
    function setting(String $key, $default = null)
    {
        return  data_get(app()->bound('settings') ? app('settings') : [], $key, $default);
    }
}


if (!function_exists('getFile')) {
    function getFile(String $path, $default = null)
    {
        if (Str::contains($path, 'assets')) {
            return url($path);
        };
        return  route('get-file', ['path' => $path]);
    }
}
if (!function_exists('userId')) {
    function userId()
    {
        return auth()?->user()?->id;
    }
}
if (!function_exists('authUser')) {
    function authUser()
    {
        return auth()?->user();
    }
}
if (!function_exists('authIsAdmin')) {
    function authIsAdmin()
    {
        return auth()?->user()?->user_type === UserTypeEnum::ADMIN->value;
    }
}
if (!function_exists('authIsUser')) {
    function authIsUser()
    {
        return auth()?->user()?->user_type === UserTypeEnum::USER->value;
    }
}
