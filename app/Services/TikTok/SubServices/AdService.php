<?php
namespace App\Services\TikTok\SubServices;
use App\Services\TikTok\TikTokService;

class AdService extends TikTokService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getAds($adAccountId, $query)
    {
        $curl = curl_init();

        $url = "/ad/get?advertiser_id=$adAccountId&". http_build_query($query);

        return $this->get($url);
    }
    public function getAd($adAccountId,$adId, $query)
    {
        $curl = curl_init();

        $url = "/ad/get?advertiser_id=$adAccountId&filtering={\"ad_id\":[\"$adId\"]}&". http_build_query($query);

        return $this->get($url);

    }
}
