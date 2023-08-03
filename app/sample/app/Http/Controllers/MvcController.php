<?php

namespace App\Http\Controllers;

use App\Http\Requests\MvcRequest;
use App\Models\User;

// ログ出力用
use Illuminate\Support\Facades\Log;

class MvcController extends Controller
{
    public function input()
    {
        return view('mvc.input');
    }

    public function output(MvcRequest $request)
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
        return view('mvc.output', ['message' => $message]);
    }
}

