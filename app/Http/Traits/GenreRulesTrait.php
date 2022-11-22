<?php


namespace App\Http\Traits;


trait GenreRulesTrait
{
    /**
     * The validation rule set.
     *
     * @var mixed
     */
    protected static $RULES = [
        'name' => ['required', 'max:30','unique:genres'],
    ];
}
