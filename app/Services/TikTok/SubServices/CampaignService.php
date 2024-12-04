<?php
namespace App\Services\TikTok\SubServices;
use App\Services\TikTok\TikTokService;

class CampaignService extends TikTokService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getCampaigns($adAccountId, $query)
    {
        $url = "/campaign/get?advertiser_id=$adAccountId&". http_build_query($query);

        return $this->get($url);

    }

    function getCampaign($adAccountId, $campaignId, $query)
    {
        $url = "/campaign/get?advertiser_id=$adAccountId&filtering={\"campaign_ids\":[\"$campaignId\"]}&". http_build_query($query);

        return $this->get($url);
    }

   
}
