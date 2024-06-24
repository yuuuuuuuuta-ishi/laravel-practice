<?php

use Illuminate\Support\Facades\Route;


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