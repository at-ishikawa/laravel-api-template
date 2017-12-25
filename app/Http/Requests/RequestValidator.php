<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RequestValidator
{
    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public static function validate(Request $request): array
    {
        $inputs = $request->all();

        $validator = new static();
        $action = $validator->getAction();
        return $validator->validateByInput($inputs, $action);
    }

    /**
     * @param array $inputs
     * @param string $action
     * @return array
     * @throws ValidationException
     */
    public function validateByInput(array $inputs, string $action): array
    {
        $rules = $this->getRules($action);
        Validator::validate($inputs, $rules);
        return array_only($inputs, array_keys($rules));
    }

    public function getAction(?string $action = null): string
    {
        if ($action === null) {
            $action = Route::currentRouteAction();
        }
        $controller_path = explode('@', $action)[0];
        $controller_route_path = explode('\\', preg_replace('/Controller$/', '', $controller_path), 4)[3];
        $controller_snake_case_path = snake_case(str_replace('\\', '', $controller_route_path));
        return str_replace('_', '.', $controller_snake_case_path);
    }

    private function getRules(string $action): array
    {
        return Config::get('requests.rules.' . $action);
    }
}
