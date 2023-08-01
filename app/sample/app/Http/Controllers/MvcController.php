<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// ログ出力用
use Illuminate\Support\Facades\Log;

class MvcController extends Controller
{
    public function input()
    {
        return view('mvc.input');
    }

    public function output(request $request)
    {
        //リクエスト情報取得
        $code = $request->input('code');
        $password = $request->input('password');

        //usersテーブルを検索
        $user = User::getUserByUserIdAndPassword($code, $password);


        //検索結果の判定
        $message = '入力されたコードまたはパスワードが違います。';
        if (is_null($user) === false || empty($user) === false) {
            $message = 'ようこそ！' . $user->name . 'さん！';
        }
        log::info($message);
        return view('mvc.output', ['message' => $message]);
    }
}

