<?php


namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function findUserByName(string $username): ?User
    {
        return $this->userModel::where('name', $username)->first();
    }
}