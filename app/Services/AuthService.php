<?php


namespace App\Services;

use App\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function isUserExists(string $username): bool
    {
        return !is_null($this->userRepository->findUserByName($username));
    }
}