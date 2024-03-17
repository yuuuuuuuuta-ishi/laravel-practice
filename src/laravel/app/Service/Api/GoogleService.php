<?php

namespace App\Service\Api;

use App\Service\HttpService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class GoogleService extends HttpService
{
    public static $GoogleService;
    function __construct()
    {
        $baseUrl = env('GOOGLE_BASE_URL');
        $clientId = env('GOOGLE_CLIENT_SECRET');
        $clientSecret = env('GOOGLE_CLIENT_ID');
        parent::__construct($baseUrl, $clientId, $clientSecret);
        $this->getToken();
    }

    public function getToken()
    {
        $url = $this::$baseUrl . '/o/oauth2/token';
        $body = [
            'code' => env('GOOGLE_CODE'),
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'grant_type' => 'authorization_code',
        ];
        $response = Http::asForm()->post($url, $body);
        Log::debug("response", $response->json());
        $this::$token =  $response->json();
    }
}
