<?php

namespace App\Http\Controllers\Snapchat\SubControllers;


use App\Http\Controllers\Snapchat\SnapchatController;
use Illuminate\Http\Request;

class CampaignController extends SnapchatController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, "App\Services\Snapchat\SubServices\CampaignService");
    }
    
    public function index(Request $request, $adAccountId)
    {
        $campaigns = $this->service->getCampaigns($adAccountId);
        return response()->json($campaigns);
    }

    public function show(Request $request, $campaignId)
    {
        $campaign = $this->service->getCampaign($campaignId);
        return response()->json($campaign);
    }

    public function stats(Request $request, $campaignId)
    {
        $params = $request->all();
        $campaigns = $this->service->getCampaignStats($campaignId, $params);
        return response()->json($campaigns);
    }

}
