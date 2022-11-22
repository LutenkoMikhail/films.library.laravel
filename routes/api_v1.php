<?php

use App\Http\Controllers\Api\v1\FilmController;
use App\Http\Controllers\Api\v1\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('/v1/genres', GenreController::class);
Route::apiResource('/v1/films', FilmController::class);


Route::fallback(function () {
    return response()->json([Config::get('constants.json.not_found')], 404);
});
