<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function index()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('admin.auth.login.index');
    }
}
