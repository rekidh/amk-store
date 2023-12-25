<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthUsers extends Controller
{
    public function login(Request $request)
    {
        try {
            $userLogin = $request->validate([
                'userName' => ['required'],
                'password' => ['required', 'min:5'],
            ]);
            if (Auth::attempt($userLogin)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            return back()->with('error', 'Login failed');
        } catch (\Throwable $th) {
            return back()->with('error', 'Login failed');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }

    public function store()
    {
    }
}
