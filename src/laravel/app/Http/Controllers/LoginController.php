<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;

// ログ出力用
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function input(request $request)
    {
        return view('input');
    }

    public function output(LoginRequest $request)
    {
        //リクエスト情報取得
        $employeeCode = $request->input('employeeCode');
        $password = $request->input('password');

        //usersテーブルを検索
        $user = User::getUserByUserIdAndPassword($employeeCode, $password);


        //検索結果の判定
        $message = '入力されたコードまたはパスワードが違います。';
        if (is_null($user) === false || empty($user) === false) {
            $message = 'ようこそ！' . $user->name . 'さん！';
        }
        log::info($message);
        return view('output', ['message' => $message]);
    }
}
