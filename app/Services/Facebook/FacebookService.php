<?php

namespace App\Services\Facebook;

use Facebook\Facebook;

class FacebookService
{
    protected $facebook;

    public function __construct($accessToken)
    {
        $this->facebook = new Facebook([
            'app_id' => env('FACEBOOK_CLIENT_ID'),
            'app_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'default_graph_version' => env('FACEBOOK_DEFAULT_GRAPH_VERSION'),
        ]);

        $this->facebook->setDefaultAccessToken($accessToken);
    }

    public function getAdAccounts()
    {
        return $this->facebook->get('/me/adaccounts?fields=id,name,account_id&limit=10000')->getDecodedBody();
    }

    public function getCampaigns($adAccountId)
    {
        return $this->facebook->get("/$adAccountId/campaigns?fields=id,name,account_id,adsets,ads,leads,insights.time_range({'since':'2023-01-01','until':'2024-12-31'}){impressions,clicks,spend}")->getDecodedBody();
    }

    public function getAdSets($campaignId)
    {
        return $this->facebook->get("/$campaignId/adsets?fields=id,name,account_id,campaign_id&limit=10000")->getDecodedBody();
    }

    public function getAds($adSetId)
    {
        return $this->facebook->get("/$adSetId/ads?fields=id,name,account_id,campaign_id,adset_id")->getDecodedBody();
    }

    public function getInsights($adAccountId, $fields, $params = [])
    {
        return $this->facebook->get("/$adAccountId/insights?fields=" . implode(',', $fields), $params)->getDecodedBody();
    }
    
    public function getLeadsFromPage($pageId)
    {
        try {
            $response = $this->facebook->get("/$pageId/leadgen_forms?fields=id,name,status,locale")->getDecodedBody();
            foreach($response['data'] as $key=>$form){
                $id = $form['id'];
                $lead = $this->facebook->get("/$id/leads")->getDecodedBody();
                if(!empty($lead['data'])){
                    $response['data'][$key]['leads'] = $lead['data'];
                }else{
                    $response['data'][$key]['leads'] = array('message'=>'No leads found in provide page id');
                }
            }
            //echo '<pre>';print_r($response);die;
            return $response;
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            return ['error' => $e->getMessage()];
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK error
            return ['error' => $e->getMessage()];
        }
    }
    
    
    
    public function getLeads($adId)
    {
        return $this->facebook->get("/$adId/leads")->getDecodedBody();
    }

    // Additional methods for metrics like impressions, clicks, spend, conversions
    public function getMetrics($adAccountId, $params)
    {
        return $this->facebook->get("/$adAccountId/insights", $params)->getDecodedBody();
    }
}
