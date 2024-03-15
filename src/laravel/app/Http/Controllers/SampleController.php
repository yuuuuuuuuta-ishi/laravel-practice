<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ログ出力用
use Illuminate\Support\Facades\Log;

class SampleController extends Controller
{
    public function input()
    {
        return view('input');
    }

    public function output(request $request)
    {
        //リクエスト情報取得
        //文字列をtimestampに変換
        $birthday = strtotime($request->input('birthday'));

        //年度取得
        $birthYear = date('Y', $birthday);

        //干支の判定
        $etoList = array("子", "丑", "寅", "卯", "辰", "巳", "午", "未", "申", "酉", "戌", "亥");
        $year = ($birthYear + 8) % 12;
        $eto = $etoList[$year];

        //星座の判定
        $zodiac = self::getZodiacFromDateTime($birthday);

        //返却文言の設定
        $message = '';
        if($zodiac){
        $message = date('Y年m月d日', $birthday) . '生まれの方は'
        .$eto.'年の'
        .$zodiac.'座です。';
        } else{
            $message = '星座が取得できませんでした。';
        }

        //返却内容をログに出力する
        log::info([
            'birthday'=> date('Y/m/d', $birthday)
            ,'eto'=> $eto
            ,'zodiac'=> $zodiac
        ]);

        return view('output', ['message' => $message]);
    }

    private static  function getZodiacFromDateTime($timestamp)
    {
        $month = (int)date('n', $timestamp);
        $day = (int)date('j', $timestamp);

        $zodiacs = array(
            array('牡羊',  3, 21,  4, 19),
            array('牡牛',  4, 20,  5, 20),
            array('双子',  5, 21,  6, 21),
            array('かに',  6, 22,  7, 22),
            array('獅子',  7, 23,  8, 22),
            array('乙女',  8, 23,  9, 22),
            array('天秤',  9, 23, 10, 23),
            array('蠍',   10, 24, 11, 22),
            array('射手', 11, 23, 12, 21),
            array('山羊', 12, 22,  1, 19),
            array('水瓶',  1, 20,  2, 18),
            array('魚',    2, 19,  3, 20)
        );

        foreach ($zodiacs as $zodiac) {
            list($name, $start_m, $start_d, $end_m, $end_d) = $zodiac;
            if (
                ($month === $start_m && $day >= $start_d) ||
                ($month === $end_m && $day <= $end_d)
            ) {
                return $name;
            }
        }
        return false;
    }
}
