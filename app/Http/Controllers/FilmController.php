<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilmRequestWeb;
use App\Http\Requests\UpdateFilmRequestWeb;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('index', [
            'films' => Film::allFilms(Config::get('constants.db.paginate_films.paginate_film_3'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('films.create', [
            'genres' => Genre::fullGenres(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFilmRequestWeb $request
     * @return RedirectResponse
     */
    public function store(StoreFilmRequestWeb $request)
    {
        Film::newFilm($request)->response();
        return redirect()->route('films.index');
    }


    /**
     *  Display the specified resource.
     *
     * @param Film $film
     * @return Application|Factory|View
     */
    public function show(Film $film)
    {
        return view('films.show', [
            'film' => Film::oneFilm($film)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Film $film
     * @return Application|Factory|View
     */
    public function edit(Film $film)
    {
        return view('films.edit',
            [
                'film' => $film,
                'genres' => Genre::fullGenres(),
            ]
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFilmRequestWeb $request
     * @param Film $film
     * @return RedirectResponse
     */
    public function update(UpdateFilmRequestWeb $request, Film $film)
    {
        Film::updateFilm($request, $film)->response();

        return redirect()->route('films.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Film $film
     * @return RedirectResponse
     */
    public function destroy(Film $film)
    {
        Film::destroyFilm($film);

        return redirect()->route('films.index');
    }


    /**
     * Publishing a resource
     *
     * @param Film $film
     * @return RedirectResponse
     */
    public function publish(Film $film)
    {
        Film::publishFilm($film);

        return redirect()->route('films.index');
    }
}
