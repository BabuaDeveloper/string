<?php
namespace App\Services\TikTok\SubServices;
use App\Services\TikTok\TikTokService;

class AuthService extends TikTokService
{
    public function __construct($token = null) {
        parent::__construct($token);
    }

   
    public function inititeLoginAttempt()
    {
        $url = "https://business-api.tiktok.com/portal/auth?app_id=".$this->clientId."&state=you_custom_params&redirect_uri=".$this->redirectUri;
        return redirect($url);
    }

    public function getTokens($code)
    {
        return $this->post('/oauth2/access_token/', [
            'app_id' => $this->clientId,
            'secret' => $this->clientSecret,
            'auth_code' => $code,
        ]);
    }

}
