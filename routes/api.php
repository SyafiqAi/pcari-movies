<?php

use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\UserRatingController;
use App\Models\Performer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    #region movies
    Route::get('genre', [MovieController::class, 'index']);
    Route::get('timeslot', [MovieController::class, 'index']);
    Route::get('specific_movie_theater', [MovieController::class, 'index']);
    Route::get('search_performer', [MovieController::class, 'index']);
    Route::get('new_movies', [MovieController::class, 'index']);
    Route::post('add_movie/{syafiq}', [MovieController::class, 'store']);
    Route::apiResource('movies', MovieController::class);
    #endregion

    #region rating
    Route::post('give_rating', [UserRatingController::class, 'store']);
    #endregion
});
