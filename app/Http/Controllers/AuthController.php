<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // TELA DE LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }


    // FAZER LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->intended(
                route('artigos.index')
            );
        }


        return back()
            ->withErrors([
                'email' => 'E-mail ou senha incorretos.',
            ])
            ->onlyInput('email');
    }


    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}