<?php

namespace App\Http\Resources\api\v1;

use App\Models\Film;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{

    public static $wrap = 'Films';

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
            'poster' => $this->poster,
            'published' => $this->published,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'genres' => $this->genres,
        ];


    }

}
