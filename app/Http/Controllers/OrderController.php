<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderStatusHistory;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Facade as Indonesia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orders.index', [
            'management' => 'orders',
            'page' => 'order-management',
            'orders' => Order::getAllOrders(),
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
        ]);
    }

    public function indexConfirmation()
    {
        $provinces = Indonesia::allProvinces();
        $cities = Indonesia::allCities();
        $districts = Indonesia::allDistricts();
        $villages = DB::table('indonesia_villages')->get();

        return view('orders.confirmation', [
            'management' => 'orders',
            'page' => 'order-confirmation',
            'orders' => Order::getAllConfirmationOrders(),
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'provinces' => $provinces,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', [
            'management' => 'orders',
            'page' => 'order-management',
            'order' => $order,
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'order_status' => OrderStatusHistory::getLatestStatusOrder($order->id)
        ]);
    }

    public function customer(Order $order)
    {
        $provinces = Indonesia::allProvinces();
        $cities = Indonesia::allCities();
        $districts = Indonesia::allDistricts();
        $villages = DB::table('indonesia_villages')->get();

        return view('orders.customer', [
            'management' => 'orders',
            'page' => 'order-management',
            'order' => $order,
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'provinces' => $provinces,
            'cities' => $cities,
            'districts' => $districts,
            'villages' => $villages
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
