<?php

namespace App\Models;

use App\Http\Resources\api\v1\FilmResource;
use App\Http\Traits\ModelPaginateTrait;
use App\Http\Traits\ModelStatusCodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

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

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    static public function allFilms($paginate)
    {

        Film::$paginate = $paginate;
        $films = Film::with('genres')->orderBy('id')->paginate(Film::$paginate);
        if (count($films) === 0) {
            Film::$statusCode = Response::HTTP_NOT_FOUND;
        }

        return $films;
    }

    static public function oneFilm(Film $film)
    {
        return new FilmResource ($film);
    }

    static public function destroyFilm(Film $film)
    {
        $message = 'Delete Failed';

        if ($film->delete() > 0) {
            $message = 'Successfully Deleted';
        }

        return response()->json(['message' => $message]);
    }

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
