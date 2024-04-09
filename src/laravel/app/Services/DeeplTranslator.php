<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\Api;

class DeeplTranslator extends Api
{

    public function __construct()
    {
        parent::$apiKey = env('DEEPL_API_KEY');
        parent::$baseUrl = 'https://api-free.deepl.com/v2';
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
            $headers = [
                'Authorization' => 'DeepL-Auth-Key ' . parent::$apiKey,
                'Content-Type' => 'application/json'
            ];
            $body = [
                'text' => $text,
                'source_lang' => $sourceLanguage,
                'target_lang' => $targetLanguage,
            ];
            $url = parent::$baseUrl.'/translate';
            $response = parent::sendRequest($url, $headers, $body);

            Log::debug('apiKey : ' . parent::$apiKey);
            Log::debug('baseUrl : ' . parent::$baseUrl);
            Log::debug('response', $response->json());

            if ($response->successful() && isset($response->json()['translations'][0]['text'])) {
                return $response->json()['translations'][0]['text'];
            }

            return 'Error: Unable to translate text';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
