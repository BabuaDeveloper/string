<?php

namespace App\Http\Controllers\Facebook;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Services\Facebook\FacebookService;
use Illuminate\Http\Request;

class FacebookAdsController extends Controller
{
    protected $facebookService;

    public function __construct(Request $request)
    {
        $accessToken = $request->bearerToken();
        if(!$accessToken) return response(['data'=>'Unauthorization Token']);
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
            'time_range' => json_encode($request->input('time_range')),
            'level' => $request->input('level'),
            'fields' => 'impressions,clicks,spend,conversions,cpc,cpm'
        ])->json();
    }

    public function getMetrics(Request $request)
    {
        $adAccountId = $request->input('ad_account_id');
        return Http::get("https://graph.facebook.com/v21.0/{$adAccountId}/insights", [
            'access_token' => $request->bearerToken(),
            'date_preset' => 'this_year',
            'level' => 'campaign',
            'fields' => 'impressions,clicks,spend,conversions,cpc,cpm,account_id,campaign_id,adset_id,ad_id'
        ])->json();
        die;        
        $params = $request->only(['time_range', 'fields', 'level']);
        $metrics = $this->facebookService->getMetrics($adAccountId, $params);
        return response()->json($metrics);
    }
    
    public function getLeadsForm(Request $request){
        echo $accessToken;die;
        $page_id = $request->input('page_id');
        echo $page_id;die;
        $form_details = Http::get("https://graph.facebook.com/v21.0/$page_id/leadgen_forms", ['access_token' => $accessToken,]);
        echo '<pre>';print_r($form_details);die;
    }
    
    public function getLeads(Request $request)
    {
        $page_id = $request->input('page_id');
        $leads = $this->facebookService->getLeadsFromPage($page_id);
        return response()->json($leads);
        die;
        
        
        
        
        $form_details = Http::get("https://graph.facebook.com/v21.0/$page_id/leadgen_forms", ['access_token' => $request->bearerToken()])->json();
        return $form_details;die;
        $lead_details = array();
        foreach($form_details->toArray() as $key=>$form){
            $form_id = $form->id;
            echo $form_id;die;
            //$lead_details[$key] = Http::get("https://graph.facebook.com/v17.0/$form_id/leads", ['access_token' => $request->bearerToken()])->json();
        }
        echo $lead_details;die;       
        
        $adAccountId = $request->input('ad_account_id');
        return Http::get("https://graph.facebook.com/v21.0/{$adAccountId}/leads", [
            'access_token' => $request->bearerToken(),
        ])->json();
        die;
        
        
        
        
        $leads = $this->facebookService->getLeads($adAccountId);
        return response()->json($leads);
    }
}
