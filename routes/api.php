<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopfansController ;
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

Route::get('topfans-index',[TopfansController::class,'index']) ;
Route::post('topfans-show',[TopfansController::class,'show']) ;
Route::post('topfans-store',[TopfansController::class,'store']) ;
Route::post('topfans-update',[TopfansController::class,'update']) ;
Route::post('topfans-delete',[TopfansController::class,'delete']) ;


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
