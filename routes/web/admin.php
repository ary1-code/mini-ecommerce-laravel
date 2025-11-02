<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IndexController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->as('admin.')->group(function () {

    // -------------------- Authenticated zone --------------------
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [LogoutController::class, 'index'])->name('logout');
    });

    // -------------------- Guest zone --------------------
    Route::prefix('auth')->as('auth.')->middleware('guest:admin')->group(function () {

        Route::controller(LoginController::class)->as('login.')->prefix('login')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('post', 'post')->name('post');
        });

    });

    Route::get('admin', [IndexController::class, 'index'])->name('admin');
});



Route::get('/test-login', function () {
    $admin = \App\Models\Admin::find(1);

    Auth::guard('admin')->login($admin);

    return 'Logged in as ' . Auth::guard('admin')->user()->first_name;
});
