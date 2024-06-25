<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class Problem2Controller
{
    public function output(Request $request){
        $message = $request['message'];
        return view('/problem2/output', compact('message'));
    }
}


