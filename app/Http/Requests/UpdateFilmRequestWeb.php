<?php

namespace App\Http\Requests;

use App\Http\Traits\GenreRulesTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRequestWeb extends FormRequest
{
    use GenreRulesTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return static::$RULES;
    }
}
