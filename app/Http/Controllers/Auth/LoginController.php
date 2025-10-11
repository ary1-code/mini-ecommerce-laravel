<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Http\Requests\Auth\RegisterPostRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

        try {
            $user = User::query()
                ->where('mobile', '=', $request->input('mobile'))
                ->first();
        } catch (Exception $exception) {
            Log::error($exception);

            return back()->withErrors([
                'general' => 'خطایی در ورورد رخ داده لطفا با پشتیبانی تماس بگیرید'
            ]);
        }
        if (!Hash::check($request->input('password'),$user->password)){

            return back()->withErrors([
                'general' => 'اطلاعات وارد شده صحیح نیست'
            ]);
        }
        Auth::login($user);
        return redirect()->route('index');
    }

}
