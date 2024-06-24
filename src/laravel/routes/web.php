<?php

use Illuminate\Support\Facades\Route;

//デフォルト

Route::get('/', function () {
    return view('welcome');
});


//練習

Route::view("/hello", "hello");


//problem1

Route::view("/problem1_input", "problem1_input");

Route::post('/problem1_output', function () {
    return view('problem1_output');
});