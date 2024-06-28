<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Exceptions;

class Problem4Controller
{
    /**
     * 入力画面を表示する関数
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     * 入力画面の表示
     */ 
    public function input(){
        return view('/problem4/input');
    }

    /**
     * 出力画面を表示する関数
     * 
     * 社員コードとパスワードで検索し、結果に応じでメッセージを返す
     * 
     * @param Request $request 社員コードとパスワード
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     * 出力画面の表示
     */ 
    public function output(Request $request){
        $code = $request['code'];
        $password = $request['password'];

        //社員コードとパスワードで検索
        $employee = new Employee();
        $employee = $employee->findByCodeAndPassword($code, $password);

        if($employee == null){
            $message = "入力されたコードまたはパスワードが違います。";
        }else{
            $message = "ようこそ！".$employee['name']." さん！";
        }

        return view('/problem4/output', compact('message'));

    }
}


