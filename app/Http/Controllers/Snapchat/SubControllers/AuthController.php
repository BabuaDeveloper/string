<?php

namespace App\Http\Controllers\Snapchat\SubControllers;

use App\Http\Controllers\Snapchat\SnapchatController;
use Illuminate\Http\Request;

class AuthController extends SnapchatController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, "App\Services\Snapchat\SubServices\AuthService");

    }

    public function login()
    {
        return $this->service->inititeLoginAttempt();
    }

    /**
     * This method is the callback from SnapChat once the user has authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        if ($request->code) {
            return $this->createToken($request);
        }
    }

    public function createToken(Request $request)
    {
        $tokens = $this->service->getTokens($request->code);
        return response()->json($tokens);
    }
    public function myProfile(Request $request)
    {
        $tokens = $this->service->myProfile();
        return response()->json($tokens);
    }
    public function refreshToken(Request $request)
    {
        $tokens = $this->service->refreshToken($request->refresh_token);
        return response()->json($tokens);
    }

}
