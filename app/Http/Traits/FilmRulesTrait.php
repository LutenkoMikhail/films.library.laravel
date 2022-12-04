<?php


namespace App\Http\Traits;


trait FilmRulesTrait
{
    /**
     * The validation rule set.
     *
     * @var mixed
     */
    protected static $RULES = [
        'name' => ['required', 'max:100'],
        'poster' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'published' => ['sometimes', 'boolean'],
        'genre_id' => ['unique:genres,id', 'array'],
    ];
}
