<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\A3RTChatController;

Route::get('/', function () {
    return view('welcome');
});

//教育課題2(blade基礎)
Route::get('/input', [SampleController::class, 'input']);

//教育課題2(blade基礎)
Route::post('/output', [SampleController::class, 'output']);


Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

Route::delete('/chat/clear', [ChatController::class, 'clearHistory'])->name('chat.clear');

