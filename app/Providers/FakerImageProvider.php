<?php

namespace App\Providers;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


final class FakerImageProvider extends Base
{
    public function placeImg($dir = '', $width = 500, $height = 500)
    {
        $name = $dir . '/' . Str:: random(6) . '.jpg';
        Storage::put($name,
            file_get_contents("https://placeimg.com/$width/$height/any"));
        return '/storage/' . $name;
    }
}

