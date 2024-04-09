<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeeplTranslator;
use App\Services\A3rt;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{

    /**
     * Handle the chat index request.
     *
     * This method handles the index request for the chat and performs the
     * necessary operations. It retrieves the request parameters, logs the
     * request, and if there is input text, it translates the text using the
     * specified API provider (default is 'deepl'). It then creates a message
     * in the database and retrieves the chat history. Finally, it returns the
     * chat.index view with the necessary data.
     *
     * @param Request $request The HTTP request object.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View The chat.index view.
     */
    public function index(Request $request)
    {
        // Retrieve request parameters with default values
        $sourceLang = $request->input('source_lang', 'en');
        $targetLang = $request->input('target_lang', 'ja');
        $inputText = $request->input('input_text', '');
        $apiProvider = $request->input('api_provider', 'deepl');

        // Log the request
        Log::debug('request', $request->all());

        // If there is input text, translate it
        if ($inputText) {
            if ($apiProvider == 'deepl') {
                // Use DeeplTranslator service to translate the text
                $deepl = app()->make('DeeplTranslator');
                $text = $deepl->translate($inputText, $sourceLang, $targetLang);
            } else {
                // Use A3rt service to translate the text
                $a3rt = app()->make('A3rt');
                $text = $a3rt->talk($inputText);
            }

            // Create a message in the database
            Message::create([
                'input_text' => $inputText,
                'text' => $text,
                'source_lang' => $sourceLang,
                'target_lang' => $targetLang,
                'api_provider' => $apiProvider
            ]);
        }

        // Retrieve chat history from the database
        $chatHistory = Message::orderBy('created_at', 'asc')->get();

        // Return the chat.index view with the data
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
