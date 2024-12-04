<?php
namespace App\Services\Snapchat\SubServices;

use App\Services\Snapchat\SnapchatService;

class AccountService extends SnapchatService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getAdAccounts($organizationId)
    {
        return $this->get("/organizations/$organizationId/adaccounts");
    }
    public function getAdAccountStats($adAccountId, $query)
    {
        $url = "/adaccounts/$adAccountId/stats?" . http_build_query($query);

        return $this->get($url);

    }

    function getInsights($adAccountId, $params)
    {
        $curl = curl_init();

        $url = "/adaccounts/$adAccountId/targeting_insights";

        $this->post($url, $params);
    }
}
