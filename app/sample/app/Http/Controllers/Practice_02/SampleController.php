<?php

namespace App\Http\Controllers\Practice_02;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ログ出力用
use Illuminate\Support\Facades\Log;

class SampleController extends Controller
{
    public function input()
    {
        return view('practice_02.input');
    }

    public function output(request $request)
    {
        $text = $request->input('text');
        return view('practice_02.output', ['text' => $text]);
    }
}
