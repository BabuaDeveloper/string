<?php
namespace App\Services\TikTok\SubServices;
use App\Services\TikTok\TikTokService;
use App\Models\TikTokLead;
use App\Helper\Pagination;

class ReportService extends TikTokService
{
    public function __construct($token) {
        parent::__construct($token);
    }
    public function getBasicReport($adAccountId, $query)
    {
        $url = "/reports/integrated/get?advertiser_id=$adAccountId&report_type=BASIC&". http_build_query($query);
        return $this->get($url);

    }   

    public function getLeadsReport($query)
    {
        return (new Pagination(TikTokLead::class, $query))->paginate();
    }
    
}
