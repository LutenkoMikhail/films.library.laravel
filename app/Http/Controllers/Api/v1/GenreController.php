<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\StoreGenreRequest;
use App\Http\Requests\api\v1\UpdateGenreRequest;
use App\Http\Resources\api\v1\GenreCollection;
use App\Http\Resources\api\v1\GenreFilmsResource;
use App\Http\Resources\api\v1\GenreResource;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class GenreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenreRequest $request)
    {
        return Genre::newGenre($request)->response()
            ->setStatusCode(Genre::$statusCode);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return Genre::allFilmsInGenre($genre, Config::get('constants.db.paginate_films.paginate_film_25'))
            ->response()
            ->setStatusCode(Genre::$statusCode);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        return Genre::updateGenre($request, $genre)->response()
            ->setStatusCode(Genre::$statusCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        return Genre::destroyGenre($genre);
    }
}
