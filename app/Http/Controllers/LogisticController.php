<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexExpedition()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.index-expedition', [
            'management' => 'logistics',
            'page' => 'logistic-expedition',
            'orders' => Order::getAllExpeditionOrders(),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function indexPickup()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.index-pickup', [
            'management' => 'logistics',
            'page' => 'logistic-pickup',
            'orders' => Order::getAllPickupOrders(),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function inputSN(Order $order)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.input-sn', [
            'management' => 'general',
            'page' => 'general',
            'order' => $order,

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function storeSN(Request $request, Order $order)
    {
        $request->validate(
            [
                'modem_sn'   => 'required|min:6|max:20|unique:orders,modem_sn',
                'adaptor_sn' => 'required|min:6|max:20|unique:orders,adaptor_sn',
                'buc_sn'     => 'required|min:6|max:20|unique:orders,buc_sn',
                'lnb_sn'     => 'required|min:6|max:20|unique:orders,lnb_sn',
                'router_sn'  => 'nullable|min:6|max:20|unique:orders,router_sn',
                'antena_sn'  => 'required|min:6|max:20|unique:orders,antena_sn',
            ],
            [
                '*.unique'   => 'Serial number sudah digunakan.',
                '*.required' => 'Serial number wajib diisi.',
                '*.min'      => 'Serial number minimal :min karakter.',
                '*.max'      => 'Serial number maksimal :max karakter.',
            ]
        );

        Order::storeSN($order->id, $request->modem_sn, $request->adaptor_sn, $request->buc_sn, $request->lnb_sn, $request->router_sn, $request->antena_sn,);

        if ($order->shipping === 'JNE') {
            return redirect('/logistics/expedition')->with('success', 'Serial number perangkat berhasil disimpan.');
        }

        if ($order->shipping === 'Ambil Ditempat') {
            return redirect('/logistics/pickup')->with('success', 'Serial number perangkat berhasil disimpan.');
        }
    }

    public function editSN(Order $order)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.edit-sn', [
            'management' => 'general',
            'page' => 'general',
            'order' => $order,

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
    public function update(Request $request, Order $order)
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
