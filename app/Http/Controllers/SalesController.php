<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'Super Admin') {
            return view('orders.index', ['management' => 'orders', 'page' => 'order-management']);
        } elseif (Auth::user()->role === 'Sales Admin') {
            return view('orders.index', ['management' => 'orders', 'page' => 'order-management']);
        } elseif (Auth::user()->role === 'Logistic Admin') {
            return view('logistics.index', ['management' => 'logistics', 'page' => 'logistic-management']);
        } elseif (Auth::user()->role === 'Service Activation Admin') {
            return view('service-activation.index', ['management' => 'service-activation', 'page' => 'service-activation-management']);
        } else {
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
