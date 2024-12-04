<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Facebook\FacebookController;
use App\Http\Controllers\TikTok\SubControllers\AuthController as TikTokAuthController;
use App\Http\Controllers\Snapchat\SubControllers\AuthController as SnapchatAuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    return view('welcome');
});


Route::prefix('facebook')->name('facebook.')->group(function(){
   Route::get('auth',[FacebookController::class,'loginUsingFacebook'])->name('login'); 
   Route::get('callback',[FacebookController::class,'callbackFromFacebook'])->name('callback'); 
});

Route::prefix('snapchat')->name('snapchat.')->group(function(){
    Route::get('login',[SnapchatAuthController::class,'login'])->name('login'); 
    Route::get('callback',[SnapchatAuthController::class,'callback'])->name('callback'); 
});

Route::prefix('tiktok')->name('tiktok.')->group(function(){
    Route::get('login',[TikTokAuthController::class,'login'])->name('login'); 
    Route::get('callback',[TikTokAuthController::class,'callback'])->name('callback'); 
});


// Route::prefix('tiktok')->name('tiktok.')->group(function(){
//   Route::get('login', [TiktokController::class, 'loginUsingTiktok'])->name('login');
//   Route::get('callback', [TiktokController::class, 'callbackFromTiktok'])->name('callback');
// });

Route::get('home', function () {
    return view('home');
});

