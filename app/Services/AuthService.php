<?php


namespace App\Services;

use App\Repositories\UserRepository;
use Auth;

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

    public function attempt(string $username, string $password): bool
    {
        return Auth::attempt([
            'name' => $username,
            'password' => $password,
        ]);
    }

    public function register(string $username, string $password): void
    {
        // create user
        $user = $this->userRepository->createUser($username, $password);

        // login with user
        Auth::login($user);
    }
}