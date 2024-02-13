<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//.............Topfans..........

Route::get('topfan-all',[App\Http\Controllers\TopfansController::class,'all']) ;
Route::get('topfan-show',[App\Http\Controllers\TopfansController::class,'show']) ;
Route::post('topfan-store',[App\Http\Controllers\TopfansController::class,'store']) ;
Route::post('topfan-update',[App\Http\Controllers\TopfansController::class,'update']) ;
Route::post('topfan-delete',[App\Http\Controllers\TopfansController::class,'delete']) ;

//...........Clubs............

Route::get('club-index',[App\Http\Controllers\ClubsController::class,'index']) ;
Route::post('club-store',[App\Http\Controllers\ClubsController::class,'store']) ;
Route::post('club-update',[App\Http\Controllers\ClubsController::class,'update']) ;
Route::post('club-delete',[App\Http\Controllers\ClubsController::class,'delete']) ;

//............Associations........

Route::get('association-index',[App\Http\Controllers\AssociationsController::class,'index']) ;
Route::post('association-store',[App\Http\Controllers\AssociationsController::class,'store']) ;
Route::post('association-update',[App\Http\Controllers\AssociationsController::class,'update']) ;
Route::post('association-delete',[App\Http\Controllers\AssociationsController::class,'delete']) ;

