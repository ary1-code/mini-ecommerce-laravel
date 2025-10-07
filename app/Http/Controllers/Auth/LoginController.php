<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\Auth\RegisterPostRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'ورود به حساب کاربری';
        return view('auth.login', [
            'title' => $title,
            'rawLayout' => true
        ]);

    }

    public function post(LoginPostRequest $request)
    {


    }

}
