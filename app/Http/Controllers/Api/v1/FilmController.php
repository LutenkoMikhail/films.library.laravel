<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\StoreFilmRequest;
use App\Http\Requests\api\v1\UpdateFilmRequest;
use App\Http\Resources\api\v1\FilmCollection;
use App\Models\Film;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

class FilmController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
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
     * @param StoreFilmRequest $request
     * @return JsonResponse
     */
    public function store(StoreFilmRequest $request)
    {
        return Film::newFilm($request)->response()
            ->setStatusCode(Film::$statusCode);
    }


    /**
     * Display the specified resource.
     *
     * @param Film $film
     * @return JsonResponse
     */
    public function show(Film $film)
    {
        return Film::oneFilm($film)
            ->response()
            ->setStatusCode(Film::$statusCode);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFilmRequest $request
     * @param Film $film
     * @return JsonResponse
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        return Film::updateFilm($request, $film)->response()
            ->setStatusCode(Film::$statusCode);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Film $film
     * @return JsonResponse
     */
    public function destroy(Film $film)
    {
        return Film::destroyFilm($film);
    }

    /**
     * Publishing a resource
     *
     * @param Film $film
     * @return JsonResponse
     */
    public function publish(Film $film)
    {
        return Film::publishFilm($film);
    }
}
