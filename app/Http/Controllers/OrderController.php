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

    public function data(Order $order)
    {
        $product = $order->product()->first();
        $activation_address = $order->activation_address()->first();

        return response()->json([
            'order' => [
                'unique_order' => $order->unique_order,
                'product_image' => $product->image_url,
                'product_name' => $product->name,
                'product_cost' => 'Rp' . number_format($order->product_cost, 0, ',', '.'),
                'created_at' => $order->created_at->translatedFormat('d F Y, H:i'),
            ],
            'address' => [
                'google_maps_url' => $activation_address->google_maps_url,
                'latitude' => $activation_address->latitude,
                'longitude' => $activation_address->longitude,
            ],
        ]);
    }

    public function customerShow(Order $order)
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

    public function customerData(Order $order)
    {
        $customer = $order->customer()->with('sales')->first();
        $provinces = Indonesia::allProvinces();
        $cities = Indonesia::allCities();
        $districts = Indonesia::allDistricts();
        $villages = DB::table('indonesia_villages')->get();

        return response()->json([
            'customer' => [
                'customer_type' => $customer->customer_type,
                'username' => $customer->username,
                'name' => $customer->name,
                'company_representative_name' => $customer->company_representative_name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'npwp' => $customer->npwp,
                'full_address' => $customer->full_address,
                'sales' => $customer->sales?->name,
                'source_information' => $customer->source_information,
            ],
            'address' => [
                'province' => $provinces->firstWhere('code', $customer->province_code)?->name,
                'city' => $cities->firstWhere('code', $customer->city_code)?->name,
                'district' => $districts->firstWhere('code', $customer->district_code)?->name,
                'village' => $villages->firstWhere('code', $customer->village_code)?->name,
                'rt' => $customer->rt,
                'rw' => $customer->rw,
                'postal_code' => $customer->postal_code,
                'full_address' => $customer->full_address,
            ],
            'contact' => $customer->customer_type !== 'Perorangan' ? [
                'contact_name' => $customer->contact_name,
                'contact_email' => $customer->contact_email,
                'contact_phone' => $customer->contact_phone,
                'contact_position' => $customer->contact_position,
            ] : null,
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
