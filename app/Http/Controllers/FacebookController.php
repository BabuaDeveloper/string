<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Facebook\Facebook;
use App\Services\FacebookAdsService;

class FacebookController extends Controller
{
    public function loginUsingFacebook(){
        //$facebookLoginUrl = Socialite::driver('facebook')->scopes(['email', 'public_profile', 'user_posts', 'user_videos', 'pages_read_engagement', 'pages_manage_posts', 'pages_show_list', 'pages_messaging', 'pages_manage_metadata', 'ads_read', 'ads_management', 'business_management'])->stateless()->redirect()->getTargetUrl();
        //return Socialite::driver('facebook')->scopes(['email', 'public_profile', 'user_posts', 'user_videos', 'pages_read_engagement', 'pages_manage_posts', 'pages_show_list', 'pages_messaging', 'pages_manage_metadata', 'ads_read', 'ads_management', 'business_management','leads_retrieval'])->redirect();
        return Socialite::driver('facebook')->scopes(['pages_read_engagement', 'pages_manage_posts', 'pages_show_list'])->redirect();
    }

    public function callbackFromFacebook(Request $request){
        $facebookUser = Socialite::driver('facebook')->stateless()->user();
        $accessToken = $facebookUser->token;
        return response()->json(['access_token'=>$accessToken,'id' => $facebookUser->getId(),'name' => $facebookUser->getName(),'email' => $facebookUser->getEmail()]);
    }






















    public function getAdAccounts(Request $request){
        $service = new FacebookAdsService($request->bearerToken());
        $accounts = $service->getAdAccounts();
        return response()->json($accounts);
    }
    public function getCampaigns(Request $request, $adAccountId){
        $service = new FacebookAdsService($request->bearerToken());
        $campaigns = $service->getCampaigns($adAccountId);
        return response()->json($campaigns);
    }

    public function getAdSets(Request $request, $campaignId){
        $service = new FacebookAdsService($request->bearerToken());
        $adSets = $service->getAdSets($campaignId);
        return response()->json($adSets);
    }

    public function getAds(Request $request, $adSetId){
        $service = new FacebookAdsService($request->bearerToken());
        $ads = $service->getAds($adSetId);
        return response()->json($ads);
    }

    public function getInsights(Request $request, $adAccountId){
        $dateRange = $request->query('date_range', 'this_year');
        $service = new FacebookAdsService($request->bearerToken());
        $insights = $service->getInsights($adAccountId, $dateRange);
        return response()->json($insights);
    }





















    public function fetchAdAccounts(){
        $facebook = new \Facebook\Facebook([
            'app_id' => config('facebook.app_id'),
            'app_secret' => config('facebook.app_secret'),
            'default_access_token' => config('facebook.access_token'),
        ]);

        try {
            $response = $facebook->get('/me/adaccounts');
            return response()->json($response->getDecodedBody());
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
}











    public function getUserData(Request $request){
        $accessToken = $request->bearerToken();
        echo 'Access Token - '.$accessToken;die;
        if (!$accessToken) {
            return response()->json(['error' => 'Access token is required'], 401);
        }
        $userData = $this->facebookService->getUserData($accessToken);
        if ($userData) {
            return response()->json($userData);
        }

        return response()->json(['error' => 'Unable to fetch data from Facebook'], 500);
    }













}
