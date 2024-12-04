<?php

namespace App\Http\Controllers\Snapchat\SubControllers;

use App\Http\Controllers\Snapchat\SnapchatController;
use Illuminate\Http\Request;

class AdSetController extends SnapchatController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, "App\Services\Snapchat\SubServices\AdSetService");
    }
    
    public function index(Request $request, $campaignId)
    {
        $adSets = $this->service->getAdSets($campaignId);
        return response()->json($adSets);
    }

    public function show(Request $request, $adsetId)
    {
        $adSet = $this->service->getAdSet($adsetId);
        return response()->json($adSet);
    }

    public function stats(Request $request, $adSetId)
    {
        $params = $request->all();
        $stats = $this->service->getAdSetStats($adSetId, $params);
        return response()->json($stats);
    }

}
