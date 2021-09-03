<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('articles', ArticleController::class);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
