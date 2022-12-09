<?php

namespace App\Models;

use App\Http\Requests\api\v1\StoreFilmRequest;
use App\Http\Requests\api\v1\UpdateFilmRequest;
use App\Http\Resources\api\v1\FilmResource;
use App\Http\Traits\ModelPaginateTrait;
use App\Http\Traits\ModelStatusCodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class Film extends Model
{
    use HasFactory,
        ModelStatusCodeTrait,
        ModelPaginateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'poster',
        'published',
    ];

    /**
     * @return BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    /**
     * @param $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    static public function allFilms($paginate)
    {

        Film::$paginate = $paginate;
        $films = Film::with('genres')->orderBy('id')->paginate(Film::$paginate);
        if (count($films) === 0) {
            Film::$statusCode = Response::HTTP_NOT_FOUND;
        }

        return $films;
    }

    /**
     * @param Film $film
     * @return FilmResource
     */
    static public function oneFilm(Film $film)
    {
        return new FilmResource ($film);
    }

    /**
     * @param UpdateFilmRequest $request
     * @param Film $film
     * @return FilmResource
     */
    static public function updateFilm(UpdateFilmRequest $request, Film $film)
    {
        if ((empty($request->poster))) {
            $film->poster = Config::get('constants.no_poster.path');
        } else {
            $film->poster = $request->poster->store("img");
        }

        if ($film->update($request->only('name', 'published'))) {
            if (!empty($request->genres)) {
                $film->genres()->detach();
                $film->genres()->attach($request->genres);
            } else {
                Film::$statusCode = Response::HTTP_NOT_FOUND;;
            }

            return new FilmResource ($film);
        }
    }

    /**
     * @param StoreFilmRequest $request
     * @return FilmResource
     */
    static public function newFilm(StoreFilmRequest $request)
    {
        Film::$statusCode = Response::HTTP_CREATED;

        if ((empty($request->poster))) {
            $request->poster = Config::get('constants.no_poster.path');
        } else {
            $request->poster = $request->poster->store("img");
        }

        $film = new Film([
            'name' => $request->name,
            'poster' => $request->poster,
            'published' => $request->has('published') ? $request->published : false,
        ]);

        if (!$film->save()) {
            Film::$statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        } else {
            $film->genres()->attach($request->genres);
        }

        return new FilmResource ($film);
    }


    /**
     * @param Film $film
     * @return \Illuminate\Http\JsonResponse
     */
    static public function destroyFilm(Film $film)
    {
        $message = 'Delete Failed';

        if ($film->delete() > 0) {
            $message = 'Successfully Deleted';
        }

        return response()->json(['message' => $message]);
    }

    /**
     * @param Film $film
     * @return \Illuminate\Http\JsonResponse
     */
    static public function publishFilm(Film $film)
    {
        $message = 'Not publish.';
        $film->published = true;
        if ($film->save()) {
            $message = 'Publish film.';
        }

        return response()->json(['message' => $message]);
    }
}
