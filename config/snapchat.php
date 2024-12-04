<?php
// config/facebook.php
return [
    "client_id" => env("SNAPCHAT_CLIENT_ID"),
    "client_secret" => env("SNAPCHAT_CLIENT_SECRET"),
    "redirect_uri" => "https://string.karobar.org/snapchat/callback",
    "api_url" => "https://adsapi.snapchat.com/v1",
    "scopes" => [
        "snapchat-marketing-api",
        "snapchat-offline-conversions-api",
    ]
];

?>
