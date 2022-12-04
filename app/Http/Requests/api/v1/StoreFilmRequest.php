<?php

namespace App\Http\Requests\api\v1;

use App\Http\Traits\FailedValidationFomrRequestTrait;
use App\Http\Traits\FilmRulesTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
{
    use FilmRulesTrait,
        FailedValidationFomrRequestTrait;

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
