<?php
namespace App\Services\Snapchat\SubServices;
use App\Services\Snapchat\SnapchatService;

class CampaignService extends SnapchatService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getCampaigns($adAccountId)
    {
        $url = "/adaccounts/$adAccountId/campaigns";

        return $this->get($url);

    }

    public function getCampaignStats($campaignId, $query)
    {

        $url = "/campaigns/$campaignId/stats?". http_build_query($query);

        return $this->get($url);

    }

    function getCampaign($campaignId)
    {
        $curl = curl_init();

        $url = "/campaigns/$campaignId";

       return $this->get($url);
    }

   
}
