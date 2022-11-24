<?php

namespace App\Models;

use App\Http\Requests\api\v1\StoreGenreRequest;
use App\Http\Requests\api\v1\UpdateGenreRequest;
use App\Http\Resources\api\v1\GenreFilmsResourse;
use App\Http\Traits\ModelPaginateTrait;
use App\Http\Traits\ModelStatusCodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class Genre extends Model
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
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function films()
    {
        return $this->BelongsToMany(Film::class);
    }

    /**
     * @param $paginate
     * @return mixed
     */
    static public function allGenres($paginate)
    {
        Genre::$paginate = $paginate;
        $genres = Genre::orderBy('id')->paginate(Genre::$paginate);
        if (count($genres) === 0) {
            Genre::$statusCode = 404;
        }

        return $genres;
    }

    /**
     * @param Genre $genre
     * @return GenreFilmsResourse
     */
    static public function allFilmsInGenre(Genre $genre, $paginate)
    {
        Film::$paginate = $paginate;
        if (!$genre->films->isNotEmpty()) {
            Genre::$statusCode = 404;
        }

        return new GenreFilmsResourse ($genre);
    }

    /**
     * @param UpdateGenreRequest $request
     * @param Genre $genre
     * @return GenreFilmsResourse
     */
    static public function updateGenre(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->name = $request->name;
        if (!$genre->save()) {
            Genre::$statusCode = 404;
        }

        return new GenreFilmsResourse ($genre);
    }

    /**
     * @param StoreGenreRequest $request
     * @return GenreFilmsResourse
     */
    static public function newGenre(StoreGenreRequest $request)
    {
        Genre::$statusCode = Response::HTTP_CREATED;
        $genre = new Genre([
            'name' => $request->name,
        ]);
        if (!$genre->save()) {
            Genre::$statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        }
        return new GenreFilmsResourse ($genre);
    }

    /**
     * @param Genre $genre
     * @return \Illuminate\Http\JsonResponse
     */
    static public function destroyGenre(Genre $genre)
    {
        $message = 'Delete Failed';

        if ($genre->films()->count() === 0) {
            if ($genre->delete() > 0) {
                $message = 'Successfully Deleted';
            }
        }

        return response()->json(['message' => $message]);
    }
}
