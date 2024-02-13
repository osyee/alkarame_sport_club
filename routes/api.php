<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimesController ;
use App\Http\Controllers\ReplacmentsController ;
use App\Http\Controllers\WearsController ;

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


/**========================Wears-Api======================== */
Route::get('Wears-index',[WearsController::class,'index']) ;
Route::get('Wears-show',[WearsController::class,'show']) ;
Route::post('Wears-store',[WearsController::class,'store']) ;
Route::get('Wears-update',[WearsController::class,'update']) ;
Route::get('Wears-delete',[WearsController::class,'delete']) ;
/**========================End Wears-Api======================== */

/**========================Primes-Api======================== */
Route::get('Primes-index',[PrimesController::class,'index']) ;
Route::get('Primes-show',[PrimesController::class,'show']) ;
Route::post('Primes-store',[PrimesController::class,'store']) ;
Route::get('Primes-update',[PrimesController::class,'update']) ;

Route::post('Primes-fileuploader',[PrimesController::class,'fileuploader']) ;
Route::get('Primes-delete',[PrimesController::class,'delete']) ;
/**========================End Primes-Api======================== */

/**========================Replacments-Api======================== */
Route::get('Replacments-index',[ReplacmentsController::class,'index']) ;
Route::get('Replacments-show/{id}',[ReplacmentsController::class,'show']) ;
Route::post('Replacments-store',[ReplacmentsController::class,'store']) ;
Route::get('Replacments-update/{id}/edit',[ReplacmentsController::class,'edit']) ;
Route::put('Replacments-update/{id}/edit',[ReplacmentsController::class,'update']) ;
Route::delete('Replacments-Destroy/{id}/Destroy',[ReplacmentsController::class,'Destroy']) ;
/**========================End Replacments-Api======================== */
