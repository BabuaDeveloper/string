<?php

namespace App\Services\TikTok;

use \App\Exceptions\TikTokException;

class TikTokService
{

    protected $accessToken,
    $apiEndPoint,
    $clientId,
    $clientSecret,
    $redirectUri;

    public function __construct($token = null)
    {
        $this->accessToken = $token;
        $this->clientId = config('tiktok.client_id');
        $this->clientSecret = config('tiktok.client_secret');
        $this->redirectUri = config('tiktok.redirect_uri');
        $this->apiEndPoint = config('tiktok.api_url');
        
    }

    public function post($url, $payload, $headers = [])
    {
       
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->prepareURL($url),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => is_array($payload) ? http_build_query($payload) : ($payload),
            CURLOPT_HTTPHEADER => array(
                ...$headers,
                "Access-Token: $this->accessToken",
            ),
        ));

        return $this->handleCurlResponse($curl);

    }

    public function get($url, $headers = [])
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->prepareURL($url),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                ...$headers,
                "Access-Token: $this->accessToken",
            ),
        ));

        return $this->handleCurlResponse($curl);

    }
    public function handleCurlResponse($curl)
    {
        
        $response = json_decode(curl_exec($curl));

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if (isset($response->display_message)) {
            throw new TikTokException($response->display_message, $statusCode);
        } else if ($statusCode != 200) {
            throw new TikTokException("Failed with: $statusCode", $statusCode);
        }

        return $response;
    }

    function prepareURL($url): string
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }

        return $this->apiEndPoint . $url;
    }

}
