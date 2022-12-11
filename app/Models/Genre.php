<?php

namespace App\Models;

use App\Http\Resources\api\v1\GenreFilmsResource;
use App\Http\Traits\ModelPaginateTrait;
use App\Http\Traits\ModelStatusCodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use LaravelIdea\Helper\App\Models\_IH_Genre_C;

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
        return $this->BelongsToMany(Film::class)->withTimestamps();
    }

    /**
     * @param $paginate
     * @return mixed
     */
    static public function allGenres($paginate)
    {
        Genre::$paginate = $paginate;
        $genres = Genre::with('films')->orderBy('id')->paginate(Genre::$paginate);
        if (count($genres) === 0) {
            Genre::$statusCode = Response::HTTP_NOT_FOUND;
        }

        return $genres;
    }

    /**
     * @return Genre|_IH_Genre_C
     */
    static public function fullGenres()
    {
        return Genre::orderBy('id')->get();
    }

    /**
     * @param Genre $genre
     * @return GenreFilmsResource
     */
    static public function allFilmsInGenre(Genre $genre, $paginate)
    {
        Film::$paginate = $paginate;
        if (!$genre->films->isNotEmpty()) {
            Genre::$statusCode = Response::HTTP_NOT_FOUND;;
        }

        return new GenreFilmsResource ($genre);
    }

    /**
     * @param FormRequest $request
     * @param Genre $genre
     * @return GenreFilmsResource
     */
    static public function updateGenre(FormRequest $request, Genre $genre, $paginate)
    {
        Film::$paginate = $paginate;
        $genre->name = $request->name;
        if (!$genre->save()) {
            Genre::$statusCode = Response::HTTP_NOT_FOUND;;
        }

        return new GenreFilmsResource ($genre);
    }

    /**
     * @param FormRequest $request
     * @return GenreFilmsResource
     */
    static public function newGenre(FormRequest $request, $paginate)
    {
        Film::$paginate = $paginate;
        Genre::$statusCode = Response::HTTP_CREATED;
        $genre = new Genre([
            'name' => $request->name,
        ]);
        if (!$genre->save()) {
            Genre::$statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        return new GenreFilmsResource ($genre);
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

    /**
     * @return bool Film destroy
     */
    public function isDestroy()
    {
        if ($this->films->count() === 0) {
            return true;
        } else {
            return false;
        }
    }
}
