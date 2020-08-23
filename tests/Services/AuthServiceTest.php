<?php

namespace Tests\Services;

use App\User;
use PHPUnit\Framework\TestCase;
use \Mockery;
use App\Services\AuthService;
use App\Repositories\UserRepository;

class AuthServiceTest extends TestCase
{
    public function testIsUserExists_userNotFound_returnFalse()
    {
        $userModel = Mockery::mock(UserRepository::class);
        $userModel->shouldReceive('findUserByName')->with("Hello")->once()->andReturn(null);
        app()->instance(UserRepository::class, $userModel);

        /** @var AuthService $service */
        $service = app()->make(AuthService::class);

        $this->assertFalse($service->isUserExists("Hello"));
    }

    public function testIsUserExists_userFound_returnTrue()
    {
        $userModel = Mockery::mock(UserRepository::class);
        $user = Mockery::mock(User::class);
        $userModel->shouldReceive('findUserByName')->with("Charlie")->once()->andReturn($user);

        app()->instance(UserRepository::class, $userModel);

        /** @var AuthService $service */
        $service = app()->make(AuthService::class);

        $this->assertTrue($service->isUserExists("Charlie"));
    }
}
