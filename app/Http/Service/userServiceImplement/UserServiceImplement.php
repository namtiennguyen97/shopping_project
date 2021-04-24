<?php


namespace App\Http\Service\userServiceImplement;


use App\Http\Repository\UserRepositoryImplement\UserRepositoryImplement;
use App\Http\Service\UserService;

class UserServiceImplement implements UserService
{
    protected $userRepository;
    public function __construct(UserRepositoryImplement $userRepositoryImplement)
    {
        $this->userRepository = $userRepositoryImplement;
    }

    public function index()
    {
        return $this->userRepository->index();
    }

    public function create($request)
    {
        // TODO: Implement create() method.
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function findOrFail($id)
    {
        // TODO: Implement findOrFail() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
