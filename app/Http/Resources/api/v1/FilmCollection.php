<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FilmCollection extends ResourceCollection
{

    public static $wrap = 'Films';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
