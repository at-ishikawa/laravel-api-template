<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidator;
use App\Http\Responses\DefaultJsonResponse;
use App\Services\User\UserCreateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserCreateController extends Controller
{
    /**
     * @param Request $request
     * @param UserCreateService $service
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle(Request $request, UserCreateService $service): JsonResponse
    {
        $input = RequestValidator::validate($request);
        $service->create($input);
        return DefaultJsonResponse::createResponse($input);
    }
}
