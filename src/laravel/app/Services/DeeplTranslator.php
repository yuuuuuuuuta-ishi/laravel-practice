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
     * Translates the given text using the DeepL API.
     *
     * @param string $text The text to translate.
     * @param string $sourceLanguage The language of the source text.
     * @param string $targetLanguage The language to translate the text into.
     * @return string The translated text or an error message.
     * @throws \Exception If an error occurs during the translation process.
     */
    public function translate(string $text, string $sourceLanguage, string $targetLanguage): string
    {
        try {
            // Log the input parameters
            Log::debug(__METHOD__, compact('text', 'sourceLanguage', 'targetLanguage'));

            // Prepare the request headers
            $headers = [
                'Authorization' => 'DeepL-Auth-Key ' . parent::$apiKey,
                'Content-Type' => 'application/json'
            ];

            // Prepare the request body
            $body = [
                'text' => $text,
                'source_lang' => $sourceLanguage,
                'target_lang' => $targetLanguage,
            ];

            // Construct the request URL
            $url = parent::$baseUrl.'/translate';

            // Log the request parameters
            Log::debug(__METHOD__, compact('url', 'headers', 'body'));

            // Send the request and get the response
            $response = parent::sendRequest($url, $headers, $body);

            // Log the response
            Log::debug(__METHOD__, ['response' => $response->json()]);

            // If the API responds with a successful status and the translated text
            if ($response->successful() && isset($response->json()['translations'][0]['text'])) {
                // Return the translated text
                $translatedText = $response->json()['translations'][0]['text'];
                Log::info(__METHOD__, compact('translatedText'));
                return $translatedText;
            }

            // Otherwise, return an error message
            Log::error(__METHOD__, ['message' => 'Error: Unable to translate text']);
            return 'Error: Unable to translate text';
        } catch (\Exception $e) {
            // If an exception occurs, return an error message
            Log::error(__METHOD__, ['message' => 'Error: ' . $e->getMessage(), 'trace' => $e->getTrace()]);
            return 'Error: ' . $e->getMessage();
        }
    }
}
