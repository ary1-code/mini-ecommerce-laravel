<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ProfilePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'اطلاعات کاربری';
        return view('account.profile', compact('title'));
    }

    public function put(ProfilePostRequest $request)
    {
        $inputs = $request->only([
            'first_name',
            'last_name',
            'email',
            'password'
        ]);

        if ($request->filled('password')) {

            $inputs['password'] = Hash::make($request->input('password'));

        }

        try {

            Auth::user()->update($inputs);
        }catch (\Exception $exception){
          Log::error($exception);

          return back()->withErrors([
              'general'=>'خطا در ذخیره اطلاعات'
          ]);


        }



        return back()->with('success-message','ویرایش اطلاعات کاربری با موفقیت انجام شد');

    }


}
