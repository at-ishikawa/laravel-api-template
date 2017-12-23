<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class DefaultJsonResponse extends JsonResponse
{
    public static function createResponse(array $data): self
    {
        return new static($data);
    }
}
