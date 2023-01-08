<?php

use App\Http\Controllers\InterestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::apiResource('interest', InterestController::class);
Route::get('interest/find/{by}/{value}', [InterestController::class, 'find']);
Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
    Route::post('/', [UserController::class, 'store']);
});
