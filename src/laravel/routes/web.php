<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Problem2Controller;


//デフォルト

Route::get('/', function () {
    return view('welcome');
});


//練習

Route::view("/hello", "hello");


//problem1

Route::view("/problem1/input", "problem1/input");

Route::post('/problem1/output', function () {
    return view('problem1/output');
});


//problem2

Route::get("/problem2/input", [Problem2Controller::class, "input"]);

Route::post('/problem2/output', [Problem2Controller::class, "output"]);
