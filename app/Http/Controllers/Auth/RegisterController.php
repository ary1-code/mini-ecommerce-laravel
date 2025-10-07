<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterPostRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $title = 'ثبت نام';
        return view('auth.register', [
            'title' => $title,
            'rawLayout' => true
        ]);

    }

    public function post(RegisterPostRequest $request)
    {


    }

}
