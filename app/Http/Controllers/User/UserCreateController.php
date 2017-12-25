<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestValidator;
use App\Http\Responses\DefaultJsonResponse;
use App\Services\User\UserCreateService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserCreateController extends Controller
{
    /**
     * @param Request $request
     * @param UserCreateService $service
     * @return JsonResponse
     * @throws AuthenticationException
     * @throws ValidationException
     * @throws Exception
     * @throws Throwable
     */
    public function handle(Request $request, UserCreateService $service): JsonResponse
    {
        $input = RequestValidator::validate($request);
        $response = $service->create($input);
        return DefaultJsonResponse::createResponse($response);
    }
}
