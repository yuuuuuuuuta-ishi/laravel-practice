<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;

Route::get('/', function () {
    return view('welcome');
});

//教育課題2(blade基礎)
Route::get('/input', [SampleController::class, 'input']);

//教育課題2(blade基礎)
Route::post('/output', [SampleController::class, 'output']);
