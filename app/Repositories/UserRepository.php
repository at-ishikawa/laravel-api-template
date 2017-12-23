<?php

namespace App\Repositories;

use App\DataStore\Database\User;
use App\Domains\UserDomain;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    /**
     * @param UserDomain $user
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(UserDomain $user): void
    {
        DB::transaction(function () use ($user) {
            User::create($user->toArray());
        });
    }
}
