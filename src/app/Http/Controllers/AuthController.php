<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role->name;

            return match ($role) {
                'ADMIN'   => redirect('/admin/dashboard'),
                'TRAINER' => redirect('/trainer/dashboard'),
                'LEARNER' => redirect('/learner/dashboard'),
                default   => redirect('/login'),
            };
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password!!',
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
