<?php
namespace App\Services\Snapchat\SubServices;
use App\Services\Snapchat\SnapchatService;

class AuthService extends SnapchatService
{
    public function __construct($token = null) {
        parent::__construct($token);
    }

    public function myProfile()
    {
        return $this->get('/me');
    }
    public function inititeLoginAttempt()
    {
        return redirect("https://accounts.snapchat.com/accounts/oauth2/auth?client_id=" . urlencode($this->clientId) .
            "&redirect_uri=" . urlencode($this->redirectURI) .
             "&response_type=code&scope=" . urlencode(implode(" ",$this->scopes)));
    }

    public function getTokens($code)
    {
        return $this->post('https://accounts.snapchat.com/login/oauth2/access_token', [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scopes,
            'code' => $code,

        ]);
    }

    public function refreshToken($token)
    {
        return $this->post('https://accounts.snapchat.com/login/oauth2/access_token', [
            'grant_type' => 'refresh_token',
            'client_id' => env("SNAPCHAT_CLIENT_ID"),
            'client_secret' => env("SNAPCHAT_CLIENT_SECRET"),
            'refresh_token' => $token,
        ]);
    }
}
