<?php
namespace App\Services\Snapchat\SubServices;
use App\Services\Snapchat\SnapchatService;

class AdService extends SnapchatService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getAds($adsetId)
    {
        $curl = curl_init();

        $url = "/adsquads/$adsetId/ads";

        return $this->get($url);
    }
    public function getAdStats($adId, $query)
    {
        $url = "/ads/$adId/stats?". http_build_query($query);
        return $this->get($url);

    }
    public function getAd($adId)
    {
        $curl = curl_init();

        $url = "/ads/$adId/";

        return $this->get($url);

    }
}
