<?php

namespace App\Service;



class HttpService
{
    protected static $baseUrl = null;
    protected static $redirectUrl = null;
    protected static $token = null;
    protected static $clientSecret = null;
    protected static $clientId = null;

    /**
     * Constructor for initializing base URL, client ID, and client secret.
     *
     * @param datatype $baseUrl description
     * @param datatype $clientId description
     * @param datatype $clientSecret description
     */
    protected function __construct($baseUrl, $clientId,$clientSecret) {
        $this::$baseUrl = $baseUrl;
        $this::$clientId = $clientId;
        $this::$clientSecret = $clientSecret;

    }

}
