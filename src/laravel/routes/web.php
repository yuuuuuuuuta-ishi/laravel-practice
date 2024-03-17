<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/login', [LoginController::class,'show'])->name('login.show');
Route::get('/login/redirect', [LoginController::class,'redirectToGoogle'])->name('login.redirect');
Route::get('/login/callback', [LoginController::class,'handleGoogleCallback'])->name('login.callback');
Route::get('/login/fail', [LoginController::class,'failLogin'])->name('login.fail');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/user/index', [UserController::class,'index'])->name('user.index');
});

