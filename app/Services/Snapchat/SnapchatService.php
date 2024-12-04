<?php

namespace App\Services\Snapchat;

use \App\Exceptions\SnapchatException;

class SnapchatService
{
    protected $scopes,
    $redirectURI,
    $accessToken,
    $apiEndPoint,
    $clientSecret,
        $clientId;

    public function __construct($token = null)
    {
        $this->scopes = config("snapchat.scopes");
        $this->apiEndPoint = config("snapchat.api_url");
        $this->clientSecret = config("snapchat.client_secret");
        $this->clientId = config("snapchat.client_id");
        $this->redirectURI = config("snapchat.redirect_uri");
        $this->accessToken = $token;
    }

    public function post($url, $payload)
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
            CURLOPT_POSTFIELDS => http_build_query($payload),
            CURLOPT_HTTPHEADER => []
        ));

        return $this->handleCurlResponse($curl);

    }

    public function get($url)
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
                "Authorization: Bearer $this->accessToken",
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
            throw new SnapchatException($response->display_message, $statusCode);
        } else if ($statusCode != 200) {
            throw new SnapchatException("Failed with: $statusCode", $statusCode);
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
