<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        dump($request->get("email"));
        dump($request->get("password"));
        // 若無資料則進行註冊作業
        // auth service -> validate or register

    }

    public function home()
    {
        return view('welcome');
    }
}
