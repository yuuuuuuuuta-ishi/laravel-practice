<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('user_id', $request->input('user_id'))->where('password', $request->input('password'))->first();

        if ($user) {
            return view('home', ['username' => $user->name]);
        } else {
            return view('login', ['message' => '入力されたユーザIDまたはパスワードが違います。']);
        }
    }
}

