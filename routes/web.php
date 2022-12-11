<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\FilmController@index');

Route::resource('films', FilmController::class)
    ->missing(function (Request $request) {
        return Redirect::route('films.index');
    });
Route::post('films/{film}/publish', [FilmController::class, 'publish'])->name('films.publication');

Route::resource('genres', GenreController::class)
    ->missing(function (Request $request) {
        return Redirect::route('genres.index');
    });
