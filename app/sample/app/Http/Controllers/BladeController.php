<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ログ出力用
use Illuminate\Support\Facades\Log;

class BladeController extends Controller
{
    public function input()
    {
        return view('blade.input');
    }

    public function output(request $request)
    {
        $text = $request->input('text');
        return view('blade.output', ['text' => $text]);
    }
}
