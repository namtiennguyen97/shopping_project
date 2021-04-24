<?php


namespace App\Http\Repository\UserRepositoryImplement;


use App\Http\Repository\EloquentImplement\EloquentImplement;
use App\Http\Repository\UserRepository;
use App\Models\User;

class UserRepositoryImplement extends EloquentImplement implements UserRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        $user = User::class;
        return $user;
    }
}
