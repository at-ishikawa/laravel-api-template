<?php

namespace App\Services\User;

use App\DataStore\Database\User;
use App\Domains\UserDomain;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use DB;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class UserCreateService extends BaseService
{
    /** @var UserRepository */
    private $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * @param array $parameters
     * @return array
     * @throws AuthenticationException
     * @throws Exception
     * @throws \Throwable
     */
    public function create(array $parameters): array
    {
        $domain = UserDomain::createFromArray($parameters);

        return DB::transaction(function () use ($domain) {
            $domain = $this->user_repository->create($domain);
            $entity = new User($domain->toArray());
            $token = Auth::guard()->fromUser($entity);
            return [
                'token' => $token,
            ];
        });
    }
}
