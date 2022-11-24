<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\StoreFilmRequest;
use App\Http\Requests\api\v1\UpdateFilmRequest;
use App\Http\Resources\api\v1\FilmCollection;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new FilmCollection
        (Film::allFilms(Config::get('constants.db.paginate_films.paginate_film_3'))))
            ->response()
            ->setStatusCode(Film::$statusCode);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilmRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return Film::oneFilm( $film)
            ->response()
            ->setStatusCode(Film::$statusCode);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        return Film::destroyFilm($film);
    }

    public function publish(Film $film)
    {
        return Film::publishFilm($film);
    }
}
