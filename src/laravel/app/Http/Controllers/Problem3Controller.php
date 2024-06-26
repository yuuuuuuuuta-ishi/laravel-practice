<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class Problem3Controller
{
    //入力画面を表示する関数
    public function input(){
        return view('/problem3/input');
    }

    //出力画面を表示する関数
    public function output(Request $request){
        //yyyy-mm-dd形式
        $birthday = $request['birthday'];

        //"-"で分割
        $birthdayArray = $this->separateBirthday($birthday);
        
        //干支の判定
        $eto = $this->judgeEto($birthdayArray["year"]);

        //星座の判定
        $seiza = $this->judgeSeiza($birthdayArray["month"], $birthdayArray["day"]);

        return view('/problem3/output', compact('birthdayArray', 'eto', 'seiza'));
    }


    //誕生日を年、月、日に分割する関数
    private function separateBirthday($birthday){
        //"-"で分割
        $birthdayTemp = explode('-', $birthday);

        //連想配列に移し替え
        $birthdayArray =array(
            "year"=>$birthdayTemp[0],
            "month"=>$birthdayTemp[1],
            "day"=>$birthdayTemp[2]
        );

        return $birthdayArray;
    }

    //干支を判定する関数
    private function judgeEto($year){
        //先頭の0を取り除く
        $year = (int)$year;

        //12の倍数の年が申年
        $etoArray = array("申", "酉", "戌", "亥", "子", "丑", "寅", "卯", "辰", "巳", "午", "未");
        $eto = $etoArray[$year % 12];
        return $eto;
    }

    //星座のを判定する関数(12月を0月として扱う)
    private function judgeSeiza($month, $day){
        //先頭の0を取り除く
        $month = (int)$month;
        $day = (int)$day;


        //0月前半の射手座からスタート
        $seizaArray = array("射手", "山羊", "水瓶", "魚", "牡羊", "牡牛", "双子", "蟹", "獅子", "乙女", "天秤", "蠍");

        //月の中で星座が切り替わる日("<"を使用する)
        $border = array(22, 20, 19, 21, 20, 21, 22, 23, 23, 23, 24, 23);

        $seiza;
        if($day < $border[$month % 12]){
            $seiza = $seizaArray[$month %12];
        }else{
            $seiza = $seizaArray[($month + 1) % 12];
        }

        return $seiza;
    }
}