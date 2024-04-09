<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\Api;

class A3RT extends Api
{
    public function __construct()
    {
        parent::$apiKey = env('A3RT_API_KEY');
        parent::$baseUrl = 'https://api.a3rt.recruit.co.jp';
    }

    /**
     * Translate text using A3RT TALK API.
     *
     * @param string $text The text to translate.
     * @return string The translated text or an error message.
     *
     * This function sends a request to A3RT TALK API for text translation.
     * If the API responds with a successful status and the translated text,
     * it is returned. Otherwise, an error message is returned.
     * In case of any exception, an error message is returned and the exception is logged.
     */
    public function talk(string $text): string
    {

        // Send a request to A3RT TALK API for text translation
        try {
            $headers = [
                'Content-Type' => 'application/json'
            ];
            $body = [
                'apikey' => parent::$apiKey,
                'query' => $text
            ];
            $url = parent::$baseUrl.'/talk/v1/smalltalk';
            $response = parent::sendRequest($url, $headers, $body);

            // If the API responds with a successful status and the translated text
            if ($response->successful() && $response->json()['status'] == 0) {
                // Log the translation response
                Log::info('A3RT response' , $response->json());
                return $response->json()['results'][0]['reply'];
            }

            // Otherwise, return an error message and log the error
            Log::error('Error: Unable to A3RT text');
            return 'Error: Unable to A3RT text';
        } catch (\Exception $e) {
            // If an exception occur, return an error message and log the exception
            Log::error('Error: ' . $e->getMessage());
            return 'Error: ' . $e->getMessage();
        }
    }
}
