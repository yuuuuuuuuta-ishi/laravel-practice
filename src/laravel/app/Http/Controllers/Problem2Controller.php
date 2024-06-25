<?php

namespace App\Http\Controllers;
class Problem2Controller
{
    public function output(Request $request){
        $message = $request['message'];
        return view('/problem2/output', compact('$message'));
    }
}


