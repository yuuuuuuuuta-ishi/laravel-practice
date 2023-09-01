<?php

namespace App\Http\Controllers\Practice_05;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practice_05\LoginRequest;
use App\Models\User;

// ログ出力用
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function input()
    {
        return view('practice_05.input');
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
        return view('practice_05.output', ['message' => $message]);
    }
}

