<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopfansController ;
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

Route::get('topfans-index',[TopfansController::class,'index']) ;
Route::post('topfans-show',[TopfansController::class,'show']) ;
Route::post('topfans-store',[TopfansController::class,'store']) ;
Route::post('topfans-update',[TopfansController::class,'update']) ;
Route::post('topfans-delete',[TopfansController::class,'delete']) ;
