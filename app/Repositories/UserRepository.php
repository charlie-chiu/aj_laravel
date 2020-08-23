<?php


namespace App\Repositories;

use App\User;
use Hash;

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

    public function createUser(string $username, string $password): User
    {
        $user = $this->userModel->newInstance([
                'name' => $username,
                'password' => Hash::make($password),
            ]
        );
        $user->save();

        return $user;
    }
}