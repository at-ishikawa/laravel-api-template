<?php

namespace App\Services\User;

use App\Domains\UserDomain;
use App\Repositories\UserRepository;
use App\Services\BaseService;

class UserCreateService extends BaseService
{
    /** @var UserRepository */
    private $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function create(array $parameters): void
    {
        $domain = UserDomain::createFromArray($parameters);
        $this->user_repository->create($domain);
    }
}
