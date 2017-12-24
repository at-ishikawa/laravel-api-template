<?php

namespace App\Repositories;

use App\DataStore\Database\User;
use App\Domains\UserDomain;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    /**
     * @param UserDomain $user
     * @return UserDomain
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(UserDomain $user): UserDomain
    {
        $eloquent = new User($user->toArray());
        $eloquent->save();
        return UserDomain::createFromArray(array_only($eloquent->toArray(), [
            'id',
            'name',
            'email',
        ]));
    }
}
