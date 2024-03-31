<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class SampleController extends Controller
{
    public function input()
    {
        return view('input');
    }

    public function output(request $request)
    {
        $text = $request->input('text');
        $response = Http::asForm()->post('https://api.a3rt.recruit.co.jp/talk/v1/smalltalk', [
            'apikey' => env('A3RT_APY_KEY'),
            'query' => $text,
        ]);
        Log::debug('message', $response->collect()->toArray());
        Log::debug($response->json());


        $deepL = Http::withHeaders(['Authorization' => 'DeepL-Auth-Key ceaa4860-7c6a-45c3-bbce-769302559ab4:fx', 'Content-Type' => 'application/json'])->asForm()->post('https://api-free.deepl.com/v2/translate', [
            'text' => $text,
            'target_lang' => "ja",
        ]);
        Log::debug('deepL', $deepL->collect()->toArray());
        Log::debug($deepL->json());
        return view('output', ['text' => json_encode($response->json()), 'deepL' => json_encode($deepL->json())]);
    }

}
