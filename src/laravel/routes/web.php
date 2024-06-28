<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Problem2Controller;
use App\Http\Controllers\Problem3Controller;
use App\Http\Controllers\Problem4Controller;


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


//problem3

Route::get("/problem3/input", [Problem3Controller::class, "input"]);

Route::post('/problem3/output', [Problem3Controller::class, "output"]);


//problem4

Route::get("/problem4/input", [Problem4Controller::class, "input"]);

Route::post('/problem4/output', [Problem4Controller::class, "output"]);