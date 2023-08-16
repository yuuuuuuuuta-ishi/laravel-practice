<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/books', 'App\Http\Controllers\BookController@index');

///ブレード基礎
Route::get('/blade', [App\Http\Controllers\BladeController::class, 'input']);
///ブレード基礎
Route::post('/blade', [App\Http\Controllers\BladeController::class, 'output']);

///Controller基礎
Route::get('/vc', [App\Http\Controllers\VcController::class, 'input']);
///Controller基礎
Route::post('/vc', [App\Http\Controllers\VcController::class, 'output']);

///MVC基礎
Route::get('/mvc', [App\Http\Controllers\MvcController::class, 'input']);
///MVC基礎
Route::post('/mvc', [App\Http\Controllers\MvcController::class, 'output']);

//総合課題
Route::group(['prefix' => 'comprehensive', 'as' => 'comprehensive.'], function () {
    ///ログインページ
    Route::get('/', [App\Http\Controllers\LoginController::class, 'index']);
    //home 勤怠入力画面
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

    //検索
    Route::post('/work/get', [App\Http\Controllers\WorkController::class, 'index'])->name('work.index');;
    //勤務登録
    Route::post('/work', [App\Http\Controllers\WorkController::class, 'store'])->name('work.store');
});

Route::group(['prefix' => 'user', 'as' => 'user'], function () {
    //一覧画面
    Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
    //詳細画面
    Route::get('/get', [App\Http\Controllers\UserController::class, 'get']);

    //新規登録画面
    Route::get('/create', [App\Http\Controllers\UserController::class, 'show']);
    //新規登録
    Route::post('/create', [App\Http\Controllers\UserController::class, 'create']);

    //新規登録
    Route::post('/update', [App\Http\Controllers\UserController::class, 'update']);

    //新規登録
    Route::post('/delete', [App\Http\Controllers\UserController::class, 'destroy']);
});
