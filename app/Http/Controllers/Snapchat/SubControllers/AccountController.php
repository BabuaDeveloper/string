<?php

namespace App\Http\Controllers\Snapchat\SubControllers;

use App\Http\Controllers\Snapchat\SnapchatController;
use Illuminate\Http\Request;

class AccountController extends SnapchatController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, "App\Services\Snapchat\SubServices\AccountService");
    }
    
    public function index(Request $request, $organizationId)
    {
        $accounts = $this->service->getAdAccounts($organizationId);
        return response()->json($accounts);

    }

    public function stats(Request $request, $adAccountId)
    {
        $params = $request->all();
        $stats = $this->service->getAdAccountStats($adAccountId, $params);
        return response()->json($stats);
    }

    public function insights(Request $request, $adAccountId)
    {
        $params = $request->all();
        $stats = $this->service->getInsights($adAccountId, $params);
        return response()->json($stats);
    }

}
