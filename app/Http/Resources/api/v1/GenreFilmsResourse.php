<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class GenreFilmsResourse extends JsonResource
{
    public static $wrap = 'Genre';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            Config::get('constants.json.films') => $this->when($this->films->isNotEmpty(), FilmResource::collection($this->films)),
        ];
    }
}
