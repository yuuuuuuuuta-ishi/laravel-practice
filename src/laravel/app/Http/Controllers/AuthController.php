<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Userモデルのインポート

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'employee_id' => 'required',
            'password' => 'required',
        ]);

        // Userモデルから直接employee_idとパスワードを比較
        $user = User::where('employee_id', $credentials['employee_id'])
                    ->where('password', $credentials['password'])
                    ->first();

        if ($user) {
            Auth::login($user);
            $request->session()->put('employee_id', $user->employee_id);
            $request->session()->put('password', $user->password);
            return redirect()->intended('/attendance')->with('success', 'ログインしました!');
        }

        return back()->withErrors([
            'login' => '従業員IDまたはパスワードが無効です',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
