<?php


namespace App\Http\Traits;


use Illuminate\Http\Response;

trait ModelStatusCodeTrait
{
    /**
     * HTTP status code.
     *
     * @var int
     */
    static public int $statusCode = Response::HTTP_OK;
}
