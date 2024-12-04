<?php
namespace App\Services\Snapchat\SubServices;
use App\Services\Snapchat\SnapchatService;

class AdSetService extends SnapchatService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getAdSets($campaignId)
    {
        $url = "/campaigns/$campaignId/adsquads/";

        return $this->get($url);
    }

    public function getAdSet($adsetId)
    {
        $url = "/adsquads/$adsetId/";

        return $this->get($url);
    }
    public function getAdSetStats($adSetId, $query)
    {

        $url = "/adsquads/$adSetId/stats?" . http_build_query($query);

        return $this->get($url);
    }
}
