<?php

namespace App\Http\Controllers\Snapchat\SubControllers;


use App\Http\Controllers\Snapchat\SnapchatController;
use Illuminate\Http\Request;

class AdController extends SnapchatController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, "App\Services\Snapchat\SubServices\AdService");
    }
    
    public function index(Request $request, $adsetId)
    {
        $ads = $this->service->getAds($adsetId);
        return response()->json($ads);
    }

    public function show(Request $request, $adId)
    {
        $ads = $this->service->getAd($adId);
        return response()->json($ads);
    }

    public function stats(Request $request, $adId)
    {
        $params = $request->all();
        $stats = $this->service->getAdStats($adId, $params);
        return response()->json($stats);
    }

}
