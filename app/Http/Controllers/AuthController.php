<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8',
        ]);
        
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8',
        ]);

        $admin = Admin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),

        
        ]);

        // Debugging Log
        logger('Validated data:', $validatedData);

        Auth::guard('admin')->login($admin);

        return redirect('/login')->with('success', 'Registrasi berhasil, Anda sudah bisa login.');
    }

        
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Login berhasil
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
