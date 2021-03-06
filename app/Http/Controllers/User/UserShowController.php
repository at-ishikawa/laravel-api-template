<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Responses\DefaultJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserShowController extends Controller
{
    public function handle(): JsonResponse
    {
        $login_user = Auth::guard()->user();
        return DefaultJsonResponse::create($login_user);
     }
}
