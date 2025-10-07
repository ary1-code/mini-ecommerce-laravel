<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::prefix('auth')->as('auth.')->group(function (){

    Route::controller(RegisterController::class)->as('register.')->prefix('register')->group(function (){

        Route::get('/','index')->name('index');
        Route::post('/','post')->name('post');

    });
    Route::controller(LoginController::class)->as('login.')->prefix('login')->group(function (){

        Route::get('/','index')->name('index');
        Route::post('/','post')->name('post');

    });

    Route::get('logout',[LogoutController::class,'index'])->name('logout');

});
