<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopfansController ;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\MatchesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ...................top fans api
Route::get('topfans-index',[TopfansController::class,'index']) ;
Route::post('topfans-show',[TopfansController::class,'show']) ;
Route::post('topfans-store',[TopfansController::class,'store']) ;
Route::post('topfans-update',[TopfansController::class,'update']) ;
Route::post('topfans-delete',[TopfansController::class,'delete']) ;

// ...................player api
    Route::get('player-store',[PlayersController::class,'store']) ;
    Route::get('player-delete/{id}',[PlayersController::class,'destroy']) ;
    Route::get('player-show',[PlayersController::class,'show']) ;
    Route::get('player-index/{id}',[PlayersController::class,'index']) ;

    Route::get('player-update/{id}',[PlayersController::class,'update']) ;
// ...................sports api

    Route::get('sport-index/{id}',[SportsController::class,'index']) ;
    Route::get('sport-show',[SportsController::class,'show']) ; 
    Route::get('sport-delete/{id}',[SportsController::class,'destroy']) ;

    Route::post('sport-store',[SportsController::class,'store']) ;
    Route::post('sport-update/{id}',[SportsController::class,'update']) ;
  
// ...................matches api
// Route::get('match-show',[MatchesController::class,'show']) ; 
// Route::get('match-store',[MatchesController::class,'store']) ; 
// Route::get('match-delete/{id}',[MatchesController::class,'destroy']) ;
