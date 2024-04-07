<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeeplTranslator
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('DEEPL_API_KEY');
    }

    /**
     * Translate text using DeepL API.
     *
     * @param string $text The text to translate.
     * @param string $sourceLanguage The language of the source text.
     * @param string $targetLanguage The language to translate the text into.
     * @return string The translated text or an error message.
     */
    public function translate(string $text, string $sourceLanguage, string $targetLanguage): string
    {
        try {
            $response = $this->sendTranslationRequest($text, $sourceLanguage, $targetLanguage);

            if ($response->successful() && isset($response->json()['translations'][0]['text'])) {
                return $response->json()['translations'][0]['text'];
            }

            return 'Error: Unable to translate text';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Send a request to DeepL API for text translation.
     *
     * @param string $text The text to translate.
     * @param string $sourceLanguage The language of the source text.
     * @param string $targetLanguage The language to translate the text into.
     * @return \Illuminate\Http\Client\Response The HTTP response.
     */
    private function sendTranslationRequest(string $text, string $sourceLanguage, string $targetLanguage): \Illuminate\Http\Client\Response
    {
        return Http::withHeaders([
            'Authorization' => 'DeepL-Auth-Key ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ])->asForm()->post('https://api-free.deepl.com/v2/translate', [
            'text' => $text,
            'source_lang' => $sourceLanguage,
            'target_lang' => $targetLanguage,
        ]);
    }
}
