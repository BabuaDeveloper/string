<?php
// config/facebook.php
return [
    "client_id" => env('TIKTOK_CLIENT_KEY'),
    "client_secret" => env('TIKTOK_CLIENT_SECRET'),
    "redirect_uri" => "https://string.karobar.org/tiktok/callback",
    "api_url" => "https://business-api.tiktok.com/open_api/v1.2",
        "leads_webhook_url" => "https://string.karobar.org/api/v1/tiktok/webhook/leads",

];


?>
