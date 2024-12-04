<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Services\FacebookService;
use Illuminate\Http\Request;

class FacebookAdsController extends Controller
{
    protected $facebookService;

    public function __construct(Request $request)
    {
        $accessToken = $request->bearerToken();
        $this->facebookService = new FacebookService($accessToken);
    }

    public function getAdAccounts()
    {
        $adAccounts = $this->facebookService->getAdAccounts();
        return response()->json($adAccounts);
    }

    public function getCampaigns(Request $request)
    {
        $adAccountId = $request->input('ad_account_id');
        $campaigns = $this->facebookService->getCampaigns($adAccountId);
        return response()->json($campaigns);
    }

    public function getAdSets(Request $request)
    {
        $campaignId = $request->input('campaign_id');
        $adSets = $this->facebookService->getAdSets($campaignId);
        return response()->json($adSets);
    }

    public function getAds(Request $request)
    {
        $adSetId = $request->input('adset_id');
        $ads = $this->facebookService->getAds($adSetId);
        return response()->json($ads);
    }

    public function getInsights(Request $request)
    {
        $adAccountId = $request->input('ad_account_id');
        return Http::get("https://graph.facebook.com/v21.0/{$adAccountId}/insights", [
            'access_token' => $request->bearerToken(),
            'date_preset' => 'this_year',
            'level' => 'account',
            'fields' => 'impressions,clicks,spend,conversions,cpc,cpm'
        ])->json();
        die;

        $adAccountId = $request->input('ad_account_id');
        $fields = ['impressions', 'clicks', 'spend', 'conversions'];
        $params = $request->only(['time_range', 'level']);
        //echo '<pre>';print_r($params);die;
        $insights = $this->facebookService->getInsights($adAccountId, $fields, $params);
        return response()->json($insights);
    }

    public function getMetrics(Request $request)
    {
        $adAccountId = $request->input('ad_account_id');
        return Http::get("https://graph.facebook.com/v21.0/{$adAccountId}/insights", [
            'access_token' => $request->bearerToken(),
            'date_preset' => 'this_year',
            'level' => 'campaign',
            'fields' => 'impressions,clicks,spend,conversions,cpc,cpm'
        ])->json();
        die;
        $params = $request->only(['time_range', 'fields', 'level']);
        $metrics = $this->facebookService->getMetrics($adAccountId, $params);
        return response()->json($metrics);
    }

    public function getLeads(Request $request)
    {
        $adId = $request->input('ad_id');
        $leads = $this->facebookService->getLeads($adId);
        return response()->json($leads);
    }
}
