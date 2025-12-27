<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function login()
    {
        return view('signin');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:3|max:8'
        ]);

        // Periksa apakah checkbox "Remember Me" dicentang
        $remember = $request->has('remember-me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Mengecek role pengguna setelah login
            if (Auth::user()->role === 'Admin') {
                // Redirect ke admin dashboard jika role adalah Admin
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal! Email atau password salah.');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
