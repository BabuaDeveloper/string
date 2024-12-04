<?php

namespace App\Http\Controllers\Snapchat;

use App\Services\SnapchatService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Controllers\Controller;

class SnapchatController extends Controller
{
    protected $service;

    public function __construct(Request $request, $service)
    {
        $accessToken = $request->bearerToken();
        $this->service = new $service($accessToken);
        
    }
}
