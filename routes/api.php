<?php

use App\Http\Controllers\ArticleController;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('articles', ArticleController::class);
});
