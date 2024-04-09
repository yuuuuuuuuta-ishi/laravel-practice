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
     * Sends a request to A3RT TALK API for text translation.
     *
     * @param string $text The text to be translated.
     * @throws \Exception If an error occurs during the request or parsing the response.
     * @return string The translated text or an error message.
     */
    public function talk(string $text): string
    {
        // Log the input text
        Log::debug('Input text', ['text' => $text]);

        try {
            // Prepare the request headers
            $headers = [
                'Content-Type' => 'application/json'
            ];

            // Prepare the request body
            $body = [
                'apikey' => parent::$apiKey,
                'query' => $text
            ];

            // Construct the request URL
            $url = parent::$baseUrl.'/talk/v1/smalltalk';

            // Send the request and get the response
            $response = parent::sendRequest($url, $headers, $body);

            // Log the request and response
            Log::debug('Request', ['headers' => $headers, 'body' => $body, 'url' => $url]);
            Log::debug('Response', $response->json());

            // If the API responds with a successful status and the translated text
            if ($response->successful() && $response->json()['status'] == 0) {
                // Log the translation response
                Log::info('A3RT response' , $response->json());

                // Return the translated text
                return $response->json()['results'][0]['reply'];
            }

            // Otherwise, return an error message and log the error
            Log::error('Error: Unable to A3RT text');
            return 'Error: Unable to A3RT text';
        } catch (\Exception $e) {
            // If an exception occurs, return an error message and log the exception
            Log::error('Error: ' . $e->getMessage());
            Log::debug('Exception', ['message' => $e->getMessage(), 'trace' => $e->getTrace()]);
            return 'Error: ' . $e->getMessage();
        }
    }
}
