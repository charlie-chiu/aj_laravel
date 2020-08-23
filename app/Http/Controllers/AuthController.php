<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->get("name");
        $password = $request->get("password");

        if ($this->authService->isUserExists($username) && !$this->authService->attempt($username, $password)) {
            return view('login', [
                'login_fail' => sprintf("try login %s with incorrect password", $username)
            ]);
        } else {
            //register
        }

        return redirect('home');
    }

    public function home()
    {
        return view('welcome');
    }
}
