<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginForm(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        };
        return to_route('auth.login')->withErrors([
            'email' => 'This email is not valid',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('auth.login')->with('success', 'You have been logged out');
    }
}
