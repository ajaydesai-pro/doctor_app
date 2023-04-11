<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\v1\DayController;
use App\Http\Controllers\Api\v1\SlotController;

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

Route::group(['prefix' => 'v1'], function (){
    Route::post('login', [AuthController::class, 'login']);
    Route::get('days', [DayController::class, 'index']);
    Route::get('slots/index', [SlotController::class, 'index']);
    Route::get('slots/{doctorId}/{dayId}', [SlotController::class, 'filter']);
    Route::group(['prefix' => 'doctor', 'middleware' => ['auth:sanctum','is.admin']], function (){
        Route::group(['prefix' => 'slot'], function (){
            Route::post('create', [SlotController::class, 'create']);
            Route::post('update', [SlotController::class, 'update']);
        });
    });
});

