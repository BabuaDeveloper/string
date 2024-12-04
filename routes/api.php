<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Facebook\FacebookAdsController;

use App\Http\Controllers\Snapchat\SubControllers\AuthController as SnapchatAuthController;
use App\Http\Controllers\Snapchat\SubControllers\AccountController as SnapchatAccountController;
use App\Http\Controllers\Snapchat\SubControllers\CampaignController as SnapchatCampaignController;
use App\Http\Controllers\Snapchat\SubControllers\AdSetController as SnapchatAdSetController;
use App\Http\Controllers\Snapchat\SubControllers\AdController as SnapchatAdController;



use App\Http\Controllers\TikTok\SubControllers\CampaignController as TikTokCampaignController;
use App\Http\Controllers\TikTok\SubControllers\AdSetController as TikTokAdSetController;
use App\Http\Controllers\TikTok\SubControllers\AdController as TikTokAdController;
use App\Http\Controllers\TikTok\SubControllers\ReportController as TikTokReportController;
use App\Http\Controllers\TikTok\SubControllers\AuthController as TikTokAuthController;
use App\Http\Controllers\TikTok\SubControllers\WebhookController as TikTokWebhookController;




Route::prefix('v1')->group(function () {
    // Facebook Makreting API
    Route::get('/facebook/adaccounts', [FacebookAdsController::class, 'getAdAccounts']);
    Route::post('/facebook/campaigns', [FacebookAdsController::class, 'getCampaigns']);
    Route::post('/facebook/adsets', [FacebookAdsController::class, 'getAdSets']);
    Route::post('/facebook/ads', [FacebookAdsController::class, 'getAds']);
    Route::post('/facebook/insights', [FacebookAdsController::class, 'getInsights']);
    Route::post('/facebook/leads', [FacebookAdsController::class, 'getLeads']);
    Route::post('/facebook/metrics', [FacebookAdsController::class, 'getMetrics']);
    Route::post('/facebook/leads_form', [FacebookAdsController::class, 'getLeadsForm']);
    Route::post('/facebook/leads', [FacebookAdsController::class, 'getLeads']);


    // TikTok APIs
    Route::prefix('tiktok')->group(function () {
        Route::get('/auth/access-token', [TikTokAuthController::class, 'createToken']);

        Route::get('/{adAccountId}/campaigns/', [TikTokCampaignController::class, 'index']);
        Route::get('/{adAccountId}/campaigns/{campaignId}', [TikTokCampaignController::class, 'show']);

        Route::get('/{adAccountId}/adsets/', [TikTokAdSetController::class, 'index']);
        Route::get('/{adAccountId}/adsets/{adsetId}', [TikTokAdSetController::class, 'show']);

        Route::get('/{adAccountId}/ads/', [TikTokAdController::class, 'index']);
        Route::get('/{adAccountId}/ads/{adId}', [TikTokAdController::class, 'show']);

        Route::get('/{adAccountId}/report/basic', [TikTokReportController::class, 'getBasicReport']);
        Route::get('/report/leads', [TikTokReportController::class, 'getLeadsReport']);

        Route::post('/webhook/leads/subscribe/{advertiseId}', [TikTokWebhookController::class, 'subscribeLeadWebhook']);
        Route::post('/webhook/leads/unsubscribe/{subscriptionId}', [TikTokWebhookController::class, 'unsubscribeLeadWebhook']);
        Route::get('/webhook/leads/subscribtions', [TikTokWebhookController::class, 'getWebhookSubscribtions']);

        Route::post('/webhook/leads', [TikTokWebhookController::class, 'handleLeadWebhook']);

    });
    
    //Snapchat APIs
    Route::prefix('snapchat')->group(function () {

        Route::get('/auth/me', [SnapchatAuthController::class, 'myProfile']);
        Route::get('/auth/access-token', [SnapchatAuthController::class, 'createToken']);
        Route::post('/auth/access-token/refresh', [SnapchatAuthController::class, 'refreshToken']);

        Route::get('/{organizationId}/accounts', [SnapchatAccountController::class, 'index']);
        Route::get('/accounts/{adAccountId}/stats', [SnapchatAccountController::class, 'stats']);
        Route::post('/accounts/{adAccountId}/insights', [SnapchatAccountController::class, 'stats']);
        
        Route::get('/{adAccountId}/campaigns/', [SnapchatCampaignController::class, 'index']);
        Route::get('/campaigns/{campaignId}', [SnapchatCampaignController::class, 'show']);
        Route::get('/campaigns/{campaignId}/stats', [SnapchatCampaignController::class, 'stats']);

        Route::get('/{campaignId}/adsets', [SnapchatAdSetController::class, 'index']);
        Route::get('/adsets/{adsetId}', [SnapchatAdSetController::class, 'show']);
        Route::get('/adsets/{adsetId}/stats', [SnapchatAdSetController::class, 'stats']);

        Route::get('/{adsetId}/ads', [SnapchatAdController::class, 'index']);
        Route::get('/ads/{adId}', [SnapchatAdController::class, 'show']);
        Route::get('/ads/{adId}/stats', [SnapchatAdController::class, 'stats']);

    });
    
    
});


