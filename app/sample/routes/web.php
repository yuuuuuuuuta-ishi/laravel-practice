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

//教育課題2(blade基礎)
Route::group(['prefix' => 'practice_02', 'as' => 'practice_02.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_02\SampleController::class, 'input']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_02\SampleController::class, 'output']);
});

//教育課題3(Controller基礎)
Route::group(['prefix' => 'practice_03', 'as' => 'practice_03.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_03\SampleController::class, 'input']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_03\SampleController::class, 'output']);
});

//教育課題4(MVC基礎基礎)
Route::group(['prefix' => 'practice_04', 'as' => 'practice_04.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_04\LoginController::class, 'input']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_04\LoginController::class, 'output']);
});

//教育課題5(リクエスト基礎)
Route::group(['prefix' => 'practice_05', 'as' => 'practice_05.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_05\LoginController::class, 'input']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_05\LoginController::class, 'output']);
});

//教育課題6(基礎総合①)
Route::group(['prefix' => 'practice_06', 'as' => 'practice_05.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_05\LoginController::class, 'input']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_05\LoginController::class, 'output']);
});


//教育課題6(基礎総合②)
Route::group(['prefix' => 'practice_06', 'as' => 'practice_06.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_06\LoginController::class, 'index']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_06\LoginController::class, 'login']);
    //勤怠情報取得
    Route::GET('/work/get', [App\Http\Controllers\Practice_06\WorkController::class, 'index'])->name('work.get');;
    //勤務登録
    Route::post('/work', [App\Http\Controllers\Practice_06\WorkController::class, 'store'])->name('work');
});

//教育課題7(基礎総合②)
Route::group(['prefix' => 'practice_07', 'as' => 'practice_07.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_07\LoginController::class, 'index']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_07\LoginController::class, 'login']);
    //勤怠情報取得
    Route::GET('/work/get', [App\Http\Controllers\Practice_07\WorkController::class, 'index'])->name('work.get');;
    //勤務登録
    Route::post('/work', [App\Http\Controllers\Practice_07\WorkController::class, 'store'])->name('work');
    //一覧画面
    Route::get('/user', [App\Http\Controllers\Practice_07\UserController::class, 'index']);
    //詳細画面
    Route::get('user/get', [App\Http\Controllers\Practice_07\UserController::class, 'get']);

    //詳細
    Route::get('user/create', [App\Http\Controllers\Practice_07\UserController::class, 'show']);
    //新規登録
    Route::post('user/create', [App\Http\Controllers\Practice_07\UserController::class, 'create']);

    //更新
    Route::post('user/update', [App\Http\Controllers\Practice_07\UserController::class, 'update']);

    //削除
    Route::post('user/delete', [App\Http\Controllers\Practice_07\UserController::class, 'destroy']);
});

//教育課題8(追加要件)
Route::group(['prefix' => 'practice_08', 'as' => 'practice_08.'], function () {
    //入力ページ
    Route::get('/', [App\Http\Controllers\Practice_08\LoginController::class, 'index']);
    //出力ページ
    Route::post('/', [App\Http\Controllers\Practice_08\LoginController::class, 'login']);
    //勤怠情報取得
    Route::GET('/work/get', [App\Http\Controllers\Practice_08\WorkController::class, 'index'])->name('work.get');;
    //勤務登録
    Route::post('/work', [App\Http\Controllers\Practice_08\WorkController::class, 'store'])->name('work.store');
    //一覧画面
    Route::get('/user', [App\Http\Controllers\Practice_08\UserController::class, 'index']);
    //詳細画面
    Route::get('/user/get', [App\Http\Controllers\Practice_08\UserController::class, 'get']);

    //登録画面
    Route::get('/user/create', [App\Http\Controllers\Practice_08\UserController::class, 'show']);
    //新規登録
    Route::post('/user/create', [App\Http\Controllers\Practice_08\UserController::class, 'create']);

    //更新
    Route::post('/user/update', [App\Http\Controllers\Practice_08\UserController::class, 'update']);

    //削除
    Route::post('/user/delete', [App\Http\Controllers\Practice_08\UserController::class, 'destroy']);
});

