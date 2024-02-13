<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopfansController ;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\WearsController;
use App\Http\Controllers\VideosController;

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

Route::get('wear-store',[WearsController::class,'store']) ;

Route::get('topfans-index',[TopfansController::class,'index']) ;
Route::post('topfans-show',[TopfansController::class,'show']) ;
Route::post('topfans-store',[TopfansController::class,'store']) ;
Route::post('topfans-update',[TopfansController::class,'update']) ;
Route::post('topfans-delete',[TopfansController::class,'delete']) ;


////////////Information
Route::post('store/Information',[InformationController::class,'store'])->name('store-Information');
Route::get('index/Information',[InformationController::class,'index'])->name('index-Information');
Route::get('destore/Information/{id}',[InformationController::class,'destore'])->name('destore-Information');
Route::get('update/Information/{id}',[InformationController::class,'update'])->name('update-Information');

////////////Statistics
Route::get('update/Statistics/{id}',[StatisticsController::class,'update'])->name('update-Statistics');
Route::get('destore/Statistics/{id}',[StatisticsController::class,'destore'])->name('destore-Statistics');
Route::get('index/Statistics',[StatisticsController::class,'index'])->name('index-Statistics');
Route::get('store/Statistics',[StatisticsController::class,'store'])->name('store-Statistics');

///////////vidio
Route::get('update/vidio/{id}',[VideosController::class,'update'])->name('update-vidio');
Route::get('store/vidio',[VideosController::class,'store'])->name('store-vidio');
Route::get('destore/vidio/{id}',[VideosController::class,'destore'])->name('destore-vidio');
Route::get('index/vidio',[VideosController::class,'index'])->name('index-vidio');

////////wear
Route::get('update/wear/{id}',[WearsController::class,'update'])->name('update-wear');
Route::get('store/wear',[WearsController::class,'store'])->name('store-wear');
Route::get('index/wear',[WearsController::class,'index'])->name('index-wear');
Route::get('destore/wear/{id}',[WearsController::class,'destore'])->name('destore-wear');











