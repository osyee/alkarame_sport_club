<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
