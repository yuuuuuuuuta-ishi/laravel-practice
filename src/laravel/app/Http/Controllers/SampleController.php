<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function input()
    {
        return view('input');
    }

    public function output(request $request)
    {
        $text = $request->input('text');
        return view('output', ['text' => $text]);
    }
}
