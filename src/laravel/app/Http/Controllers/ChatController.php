<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeeplTranslator;
use App\Services\A3rt;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{

    public function index(Request $request)
    {
        $sourceLang = $request->input('source_lang', 'en');
        $targetLang = $request->input('target_lang', 'ja');
        $inputText = $request->input('input_text', '');
        $apiProvider = $request->input('api_provider', 'deepl');

        Log::debug('request', $request->all());

        if ($inputText) {
            if ($apiProvider == 'deepl') {
                $deepl = app()->make('DeeplTranslator');
                $translatedText = $deepl->translate($inputText, $sourceLang, $targetLang);
            } else {
                $a3rt = app()->make('A3rt');
                $translatedText = $a3rt->talk($inputText);
            }

            Message::create([
                'input_text' => $inputText,
                'translated_text' => $translatedText,
                'source_lang' => $sourceLang,
                'target_lang' => $targetLang,
                'api_provider' => $apiProvider
            ]);
        }

        $chatHistory = Message::orderBy('created_at', 'asc')->get();

        return view('chat.index', [
            'sourceLang' => $sourceLang,
            'targetLang' => $targetLang,
            'inputText' => $inputText,
            'chatHistory' => $chatHistory,
            'apiProvider' => $apiProvider
        ]);
    }

    public function clearHistory(Request $request)
    {
        Message::truncate();
        return redirect()->route('chat.index');
    }
}
