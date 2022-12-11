<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequestWeb;
use App\Http\Requests\UpdateGenreRequestWeb;
use App\Models\Genre;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('genres.index', [
            'genres' => Genre::allGenres(Config::get('constants.db.paginate_genres.paginate_genre_3'))
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('genres.create');
    }


    /**
     * Store a newly created resource in storage
     *
     * @param StoreGenreRequestWeb $request
     * @return RedirectResponse
     */
    public function store(StoreGenreRequestWeb $request)
    {
        Genre::newGenre($request, Config::get('constants.db.paginate_genres.paginate_genre_3'))->response();

        return redirect()->route('genres.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(Genre $genre)
    {
        return view('genres.show', [
            'genre' => $genre,
            'films' => $genre->films()->get()->paginate(Config::get('constants.db.paginate_films.paginate_film_3')),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Genre $genre
     * @return Application|Factory|View
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit',
            [
                'genre' => $genre,
            ]
        );
    }


    /**
     *
     * Update the specified resource in storage.
     *
     * @param UpdateGenreRequestWeb $request
     * @param Genre $genre
     * @return RedirectResponse
     */
    public function update(UpdateGenreRequestWeb $request, Genre $genre)
    {
        Genre::updateGenre($request, $genre, Config::get('constants.db.paginate_films.paginate_film_3'))->response();

        return redirect()->route('genres.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Genre $genre
     * @return RedirectResponse
     */
    public function destroy(Genre $genre)
    {
        Genre::destroyGenre($genre);

        return redirect()->route('genres.index');
    }
}
