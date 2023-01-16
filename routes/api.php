<?php

use App\Http\Controllers\Admin\InterestAdminController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\Admin\RoleAdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::apiResource('roles', RoleController::class);
Route::apiResource('interest', InterestController::class);
Route::get('interest/find/{by}/{value}', [InterestController::class, 'find']);
Route::post('/users', [UserController::class, 'store']);

Route::group(['middleware' => 'api', 'prefix' => 'admin', 'as' => 'admin. '], function ($router) {
    Route::apiResource('interest', InterestAdminController::class);
    Route::apiResource('roles', RoleAdminController::class);
    Route::get('interest/find/{by}/{value}', [InterestAdminController::class, 'find']);
    Route::get('roles/find/{by}/{value}', [RoleAdminController::class, 'find']);
});
