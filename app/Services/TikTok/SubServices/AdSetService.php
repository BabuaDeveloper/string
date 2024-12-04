<?php
namespace App\Services\TikTok\SubServices;
use App\Services\TikTok\TikTokService;

class AdSetService extends TikTokService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getAdSets($adAccountId, $query)
    {
        $url = "/adgroup/get/?advertiser_id=$adAccountId&". http_build_query($query);

        return $this->get($url);
    }

    public function getAdSet($adAccountId, $adsetId, $query)
    {
        $url = "/adgroup/get/?advertiser_id=$adAccountId&filtering={\"adgroup_ids\":[\"$adsetId\"]}". http_build_query($query);

        return $this->get($url);
    }
}
