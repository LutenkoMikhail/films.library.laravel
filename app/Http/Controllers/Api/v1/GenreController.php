<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\StoreGenreRequest;
use App\Http\Requests\api\v1\UpdateGenreRequest;
use App\Http\Resources\api\v1\GenreCollection;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return (new GenreCollection
        (Genre::allGenres(Config::get('constants.db.paginate_genres.paginate_genre_25'))))
            ->response()
            ->setStatusCode(Genre::$statusCode);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGenreRequest $request
     * @return JsonResponse
     */
    public function store(StoreGenreRequest $request)
    {
        return Genre::newGenre($request,Config::get('constants.db.paginate_genres.paginate_genre_25'))->response()
            ->setStatusCode(Genre::$statusCode);
    }


    /**
     * Display the specified resource.
     *
     * @param Genre $genre
     * @return JsonResponse
     */
    public function show(Genre $genre)
    {
        return Genre::allFilmsInGenre($genre, Config::get('constants.db.paginate_films.paginate_film_3'))
            ->response()
            ->setStatusCode(Genre::$statusCode);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGenreRequest $request
     * @param Genre $genre
     * @return JsonResponse
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {

        return Genre::updateGenre($request, $genre, Config::get('constants.db.paginate_films.paginate_film_3'))->response()
            ->setStatusCode(Genre::$statusCode);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Genre $genre
     * @return JsonResponse
     */
    public function destroy(Genre $genre)
    {
        return Genre::destroyGenre($genre);
    }
}
