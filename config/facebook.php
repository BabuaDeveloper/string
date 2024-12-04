<?php
// config/facebook.php
return [
    'app_id' => env('FACEBOOK_APP_ID'),
    'app_secret' => env('FACEBOOK_APP_SECRET'),
    'default_graph_version' => 'v21.0',
    'access_token' => env('FACEBOOK_PAGE_ACCESS_TOKEN'), // User or Page token
];


?>
