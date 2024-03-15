<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/input', [SampleController::class, 'input']);
Route::post('/output', [SampleController::class, 'output']);
