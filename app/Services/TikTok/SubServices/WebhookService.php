<?php

namespace App\Services\TikTok\SubServices;

use App\Models\TikTokLead;
use App\Services\TikTok\TikTokService;
use Illuminate\Support\Carbon;

class WebhookService extends TikTokService
{
    public function __construct($token)
    {
        parent::__construct($token);
    }

    public function saveLeads($leads)
    {
        try {
            foreach ($leads as $lead) {
                $changes = $lead["changes"];

                $changeObject = [];

                foreach ($changes as $key => $change) {
                    $changeObject[$change["field"]] = $change["value"];
                }

                $record = new TikTokLead([
                    "page_id" => $lead["page_id"],
                    "page_name" => $lead["page_name"],
                    "campaign_id" => $lead["campaign_id"],
                    "campaign_name" => $lead["campaign_name"],
                    "adgroup_id" => $lead["adgroup_id"],
                    "adgroup_name" => $lead["adgroup_name"],
                    "ad_id" => $lead["ad_id"],
                    "ad_name" => $lead["ad_name"],
                    "create_time" => Carbon::createFromTimestamp($lead["create_time"]),
                    "advertiser_id" => $lead["advertiser_id"],
                    "advertiser_name" => $lead["advertiser_name"],
                    "library_id" => $lead["library_id"],
                    "form_values" => json_encode($changeObject),
                ]);

                $record->save();
            }
            return response([
                "status" => "success",
            ], 200);
        } catch (\Throwable $th) {
            return response([
                "status" => "error",
            ], 400);
        }
    }

    public function subscribeLeads($advertiser_id)
    {
        $url = "/subscription/subscribe/";

        $response = $this->post(
            $url,
            json_encode([
                "app_id" => $this->clientId,
                "secret" => $this->clientSecret,
                "object" => "LEAD",
                "url" => config("tiktok.leads_webhook_url"),
                "subscription_detail" => [
                    "access_token" => $this->accessToken,
                    "advertiser_id" => $advertiser_id,
                ],
            ]),
            [
                'Content-Type: application/json',
            ]
        );

        return $response;
    }

    public function subscriptionList($query)
    {
        $url = "/subscription/get/?app_id=$this->clientId&secret=$this->clientSecret&object=LEAD&" . http_build_query($query);
        return $this->get($url);
    }
    public function unsubscribeLeads($subscription_id)
    {
        $url = "/subscription/unsubscribe/";

        $response = $this->post(
            $url,
            json_encode([
                "app_id" => $this->clientId,
                "secret" => $this->clientSecret,
                "subscription_id" => $subscription_id,
            ]),
            [
                'Content-Type: application/json',
            ]
        );

        return $response;
    }
}
