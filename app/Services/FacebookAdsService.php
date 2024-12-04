<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FacebookAdsService
{
    protected $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    // Get Ad Accounts
    public function getAdAccounts()
    {
        return Http::get("https://graph.facebook.com/v21.0/me/adaccounts", [
            'access_token' => $this->accessToken,
        ])->json();
    }

    // Get Campaigns under an Ad Account
    public function getCampaigns($adAccountId)
    {
        return Http::get("https://graph.facebook.com/v21.0/{$adAccountId}/campaigns", [
            'access_token' => $this->accessToken,
        ])->json();
    }

    // Get Ad Sets under a Campaign
    public function getAdSets($campaignId)
    {
        return Http::get("https://graph.facebook.com/v21.0/{$campaignId}/adsets", [
            'access_token' => $this->accessToken,
        ])->json();
    }

    // Get Ads under an Ad Set
    public function getAds($adSetId)
    {
        return Http::get("https://graph.facebook.com/v21.0/{$adSetId}/ads", [
            'access_token' => $this->accessToken,
        ])->json();
    }

    // Get Insights for an Ad Account
    public function getInsights($adAccountId, $dateRange = 'last_30d')
    {
        return Http::get("https://graph.facebook.com/v21.0/{$adAccountId}/insights", [
            'access_token' => $this->accessToken,
            'date_preset' => $dateRange,
        ])->json();
    }

    // Additional methods for creating campaigns, ad sets, etc., can go here
}
