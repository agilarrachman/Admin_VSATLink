<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    public function index()
    {
        $user = Auth::user();        

        if ($user->role === 'Super Admin') {
            // Log::info('Redirect ke /orders');
            return redirect('/orders');
        } elseif ($user->role === 'Sales Admin') {
            // Log::info('Redirect ke /orders');
            return redirect('/orders');
        } elseif ($user->role === 'Logistic Admin') {
            // Log::info('Redirect ke /logistics');
            return redirect('/logistics/expedition');
        } elseif ($user->role === 'Service Activation Admin') {
            // Log::info('Redirect ke /service-activation');
            return redirect('/service-activation');
        } else {
            // Log::warning('Role tidak dikenal, redirect ke /login', [
            //     'role' => $user->role
            // ]);
            return redirect('/login');
        }
    }

    public function signin()
    {
        return view('signin');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:3|max:12'
        ]);

        // Periksa apakah checkbox "Remember Me" dicentang
        $remember = $request->has('remember-me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal! Username atau password salah.');
    }

    public function signout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function profile()
    {
        return view('profile', ['management' => 'profile', 'page' => 'profile']);
    }
}
