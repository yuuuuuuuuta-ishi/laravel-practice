<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class Problem2Controller
{
    public function input(){
        return view('/problem2/input');
    }

    public function output(Request $request){
        $message = $request['message'];
        return view('/problem2/output', compact('message'));
    }
}


