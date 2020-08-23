<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->get("name");
        $password = $request->get("password");

        //dev

        if ($username === "charlie") {
            Auth::loginUsingId(1);
            dump(Auth::user());
        } else {
            return redirect('home');
        }

        //-----------------------

        // 若無資料則進行註冊作業
        // auth service -> validate or register
        /*
         * if exists() {
         *     validate()
         *
         *     redirect if invalid
         * } else {
         *     register()
         * }
         */

        return redirect('home');
    }

    public function home()
    {
        return view('welcome');
    }
}
