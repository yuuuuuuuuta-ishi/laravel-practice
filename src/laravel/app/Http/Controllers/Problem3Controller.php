<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;


class Problem3Controller
{
    /**
     * 入力画面を表示する関数
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     * 入力画面の表示
     */ 
    public function input(){
        return view('/problem3/input');
    }

    /**
     * 出力画面を表示する関数
     * 
     * 干支と星座を判定して出力画面に渡している
     * 
     * @param Request $request 生年月日
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     * 出力画面の表示,生年月日、干支、星座を渡す
     */
    public function output(Request $request){
        $birthday = new Carbon($request['birthday']);

        //干支の判定
        $eto = $this->judgeEto($birthday->year);

        //星座の判定
        $seiza = $this->judgeSeiza($birthday->month, $birthday->day);

        return view('/problem3/output', compact('birthday', 'eto', 'seiza'));
    }


    /**
     * 干支を判定する関数
     * 
     * @param int $year
     * 
     * @return string $eto
     */
    private function judgeEto($year){

        //12の倍数の年が申年
        $etoArray = array("申", "酉", "戌", "亥", "子", "丑", "寅", "卯", "辰", "巳", "午", "未");
        $eto = $etoArray[$year % 12];
        return $eto;
    }

    /**
     * 星座のを判定する関数(12月を0月として扱う)
     * 
     * @param int $month
     * @param int $day
     * 
     * @return string $seiza
     */
    private function judgeSeiza($month, $day){

        //0月前半の射手座からスタート
        $seizaArray = array("射手", "山羊", "水瓶", "魚", "牡羊", "牡牛", "双子", "蟹", "獅子", "乙女", "天秤", "蠍");

        //月の中で星座が切り替わる日("<"を使用する)
        $border = array(22, 20, 19, 21, 20, 21, 22, 23, 23, 23, 24, 23);

        if($day < $border[$month % 12]){
            $seiza = $seizaArray[$month %12];
        }else{
            $seiza = $seizaArray[($month + 1) % 12];
        }

        return $seiza;
    }
}