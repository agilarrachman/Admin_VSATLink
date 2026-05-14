<?php

namespace App\Http\Controllers;

use App\Models\ActivationNota;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        $monthlyComparison = Order::monthlyRevenueComparison();
        $weeklyComparison = Order::weeklyRevenueComparison();
        $dailyComparison = Order::dailyRevenueComparison();

        $weeklyChart = Order::weeklyRevenueChart();
        $dailyChart = Order::dailyRevenueChart();

        return view('index', [
            'management' => 'dashboard',
            'page' => 'dashboard',

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),

            'logisticsPendingTotal' =>
            $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,

            'logisticsExpeditionPendingCount' =>
            $logisticsExpeditionPendingCount,

            'logisticsPickupPendingCount' =>
            $logisticsPickupPendingCount,

            'activationSchedulePendingCount' =>
            ActivationNota::activationSchedulePendingCount(),

            'totalRevenue' => Order::totalRevenue(),

            'totalActiveOrders' => Order::totalActiveOrders(),

            'totalOnProgressActivation' =>
            ActivationNota::totalOnProgress(),

            'activeVSAT' =>
            ActivationNota::activeVSAT(),

            'totalOrders' => Order::totalOrders(),

            'productStats' => Product::statistics(),

            'monthlyRevenue' => Order::monthlyRevenueChart(),

            'monthlyDifference' =>
            $monthlyComparison['difference'],

            'monthlyPercentage' =>
            $monthlyComparison['percentage'],

            'currentMonthRevenue' =>
            $monthlyComparison['current'],

            'lastMonthRevenue' =>
            $monthlyComparison['last'],

            'weeklyRevenue' =>
            $weeklyChart['revenue'],

            'weeklyCategories' =>
            $weeklyChart['categories'],

            'weeklyDifference' =>
            $weeklyComparison['difference'],

            'weeklyPercentage' =>
            $weeklyComparison['percentage'],

            'dailyRevenue' =>
            $dailyChart['revenue'],

            'dailyCategories' =>
            $dailyChart['categories'],

            'dailyDifference' =>
            $dailyComparison['difference'],

            'dailyPercentage' =>
            $dailyComparison['percentage'],

            'activationLocations' =>
            Order::activationLocations(),
        ]);
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
        return redirect('/login');
    }

    public function profile()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('profile', [
            'management' => 'profile',
            'page' => 'profile',

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }
}
