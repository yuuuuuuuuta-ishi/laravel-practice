<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ApiAccessLog;

class Api
{
    protected static $apiKey = null;
    protected static $baseUrl = null;

    /**
     * Sends a HTTP POST request to the specified URL with the given headers and body.
     * Saves the API access log after the request is completed.
     *
     * @param string $url The URL to send the request to.
     * @param array $headers The headers to include in the request.
     * @param array $body The body of the request.
     * @return \Illuminate\Http\Client\Response The response from the HTTP client.
     */
    protected function sendRequest(string $url, array $headers, array $body): \Illuminate\Http\Client\Response
    {
        // Log the request details
        Log::debug("Sending request to {$url}");
        Log::debug("Headers: " . json_encode($headers));
        Log::debug("Body: " . json_encode($body));

        // Send the HTTP POST request
        $response = Http::withHeaders($headers)->asForm()->post($url, $body);

        // Log the response details
        Log::debug("Request completed with status code {$response->status()}");
        Log::debug("Response body: {$response->body()}");

        // Save the API access log
        $this->saveApiAccessLog(
            $url,
            $headers,
            $body,
            $response->status(),
            $response->body(),
            $this->parseApiPath($url),
            $this->getServiceName($url)
        );

        // Return the response from the HTTP client
        Log::debug("Returning response");
        return $response;
    }

    /**
     * Save the API access log to the database.
     *
     * @param string $url The URL that the request was sent to.
     * @param array $headers The headers included in the request.
     * @param array $body The body of the request.
     * @param int $statusCode The status code of the response.
     * @param string $responseBody The body of the response.
     * @param string $apiPath The API path of the request.
     * @param string $serviceName The name of the service that the request was sent to.
     * @return void
     */
    protected function saveApiAccessLog(
        string $url,
        array $headers,
        array $body,
        int $statusCode,
        string $responseBody,
        string $apiPath,
        string $serviceName
    ): void {
        // Log the function call
        Log::debug(__METHOD__);

        // Log the request details
        Log::debug("URL: {$url}");
        Log::debug("Headers: " . json_encode($headers));
        Log::debug("Body: " . json_encode($body));
        Log::debug("Status Code: {$statusCode}");
        Log::debug("Response Body: {$responseBody}");
        Log::debug("API Path: {$apiPath}");
        Log::debug("Service Name: {$serviceName}");

        // Create a new instance of the ApiAccessLog model
        $apiAccessLog = new ApiAccessLog();

        // Set the properties of the model
        $apiAccessLog->url = $url;
        $apiAccessLog->request = json_encode([
            'headers' => $headers,
            'body' => $body,
        ]);
        $apiAccessLog->response = $responseBody;
        $apiAccessLog->status_code = $statusCode;
        $apiAccessLog->api_path = $apiPath;
        $apiAccessLog->service_name = $serviceName;

        // Log the model properties
        Log::debug("Model: " . json_encode($apiAccessLog->getAttributes()));

        // Save the model to the database
        $apiAccessLog->save();

        // Log the success message
        Log::debug("Logged API access");
    }


    /**
     * Parses the URL and returns the API path.
     *
     * @param string $url The URL to parse.
     * @return string The API path.
     */
    protected function parseApiPath(string $url): string
    {
        $parsedUrl = parse_url($url);

        // Return the 'path' component of the parsed URL.
        return $parsedUrl['path'];
    }


    /**
     * Returns the name of the external service based on the given URL.
     *
     * This method simply returns the host name of the URL. However, in a real application,
     * you would need to implement the appropriate logic to return the appropriate
     * external service name based on the URL.
     *
     * @param string $url The URL to parse.
     * @return string The name of the external service.
     */
    protected function getServiceName(string $url): string
    {
        // Parse the URL and extract the host name
        $parsedUrl = parse_url($url);

        // Return the host name as the name of the external service
        return $parsedUrl['host'];
    }
}
