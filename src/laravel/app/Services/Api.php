<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ApiAccessLog;

class Api
{
    protected static $apiKey = null;
    protected static $baseUrl = null;

    protected function sendRequest($url, $headers, $body): \Illuminate\Http\Client\Response
    {
        $response = Http::withHeaders($headers)->asForm()->post($url, $body);
        $this->saveApiAccessLog($url, $headers, $body, $response->status(), $response->body(), $this->parseApiPath($url), $this->getServiceName($url));
        return $response;
    }

    protected function saveApiAccessLog($url, $headers, $body, $statusCode, $responseBody, $apiPath, $serviceName)
    {
        $apiAccessLog = new ApiAccessLog();
        $apiAccessLog->url = $url;
        $apiAccessLog->request = json_encode([
            'headers' => $headers,
            'body' => $body,
        ]);
        $apiAccessLog->response = $responseBody;
        $apiAccessLog->status_code = $statusCode;
        $apiAccessLog->api_path = $apiPath;
        $apiAccessLog->service_name = $serviceName;
        $apiAccessLog->save();
    }

    protected function parseApiPath($url)
    {
        $parsedUrl = parse_url($url);
        return $parsedUrl['path'];
    }

    protected function getServiceName($url)
    {
        // ここでは単純にホスト名を返していますが、実際のアプリケーションに合わせて
        // 適切な外部サービス名を返すロジックを実装する必要があります。
        $parsedUrl = parse_url($url);
        return $parsedUrl['host'];
    }
}
