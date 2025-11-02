<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\AdminStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginPostRequest;
use App\Models\Admin;
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
        return view('admin.auth.login', [
            'title' => $title,
            'rawLayout' => true
        ]);

    }

    public function post(LoginPostRequest $request)
    {

        try {
            $admin = Admin::query()
                ->where('email', '=', $request->input('email'))
                ->first();

        } catch (Exception  $exception) {
            Log::error($exception);
            return back()->withErrors([
                'general' => 'خطایی در ورورد رخ داده لطفا با پشتیبانی تماس بگیرید'
            ]);
        }

        if ($admin->status !== AdminStatus::ACTIVE) {
            return back()->withErrors([
                'general' => 'حساب کاربری شما غیر فعال است'
            ]);
        }

        if (!Hash::check($request->input('password'), $admin->password)) {

            return back()->withErrors([
                'general' => 'اطلاعات وارد شده صحیح نیست'
            ]);
        }
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.dashboard');
    }

}
