<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimesController ;
use App\Http\Controllers\ReplacmentsController ;
use App\Http\Controllers\WearsController ;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\EmployeesController ;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\SessionsController;
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
Route::get('update/wear/{id}',[WearsController::class,'update'])->name('update-wear');
Route::get('store/wear',[WearsController::class,'store'])->name('store-wear');
Route::get('index/wear',[WearsController::class,'index'])->name('index-wear');
Route::get('destore/wear/{id}',[WearsController::class,'destore'])->name('destore-wear');
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




Route::get('employee-index',[EmployeesController::class,'index']) ;
Route::post('employee-store',[EmployeesController::class,'store']) ;
Route::post('employee-update',[EmployeesController::class,'update']) ;
Route::post('employee-delete',[EmployeesController::class,'delete']) ;
Route::get('employee-search', [EmployeesController::class,'search']);

Route::get('plan-index',[PlansController::class,'index']) ;
Route::get('plan-store',[PlansController::class,'store']) ;
Route::get('plan-delete',[PlansController::class,'delete']) ;

Route::get('session-index',[SessionsController::class,'index']) ;
Route::get('session-store',[SessionsController::class,'store']) ;
Route::get('session-update',[SessionsController::class,'update']) ;
Route::get('session-delete',[SessionsController::class,'delete']) ;
