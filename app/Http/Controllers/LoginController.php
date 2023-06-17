<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function showLoginForm()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_ktp' => '',
            'fullname' => '',
            'phone_number' => '',
            'address' => '',
            'nationality' => '',
            'status' => 'aktif',
            'role' => 'user'
        ]);

        if ($user) {
            Auth::login($user);

            return redirect('/dashboard')->with('success', 'Registration successful. Welcome to our application!');
        } else {
            return back()->withInput()->withErrors(['registration' => 'Registration failed. Please try again.']);
        }
    }


}

