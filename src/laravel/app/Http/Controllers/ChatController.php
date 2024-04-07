<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeeplTranslator;
use App\Models\Message;

class ChatController extends Controller
{
    private $deeplTranslator;

    public function __construct(DeeplTranslator $deeplTranslator)
    {
        $this->deeplTranslator = $deeplTranslator;
    }

    public function index(Request $request)
    {
        $sourceLang = $request->input('source_lang', 'en');
        $targetLang = $request->input('target_lang', 'ja');
        $inputText = $request->input('input_text', '');

        if ($inputText) {
            $translatedText = $this->deeplTranslator->translate($inputText, $sourceLang, $targetLang);
            Message::create([
                'input_text' => $inputText,
                'translated_text' => $translatedText,
                'source_lang' => $sourceLang,
                'target_lang' => $targetLang
            ]);
        }

        $chatHistory = Message::orderBy('created_at', 'desc')->get();

        return view('chat.index', [
            'sourceLang' => $sourceLang,
            'targetLang' => $targetLang,
            'inputText' => $inputText,
            'chatHistory' => $chatHistory
        ]);
    }

    public function clearHistory(Request $request)
    {
        Message::truncate();
        return redirect()->route('chat.index');
    }
}
