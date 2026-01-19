<?php

namespace App\Http\Controllers;

use App\Models\ActivationNota;
use App\Http\Requests\StoreActivationNotaRequest;
use App\Http\Requests\UpdateActivationNotaRequest;
use App\Models\ActivationStatusHistory;
use App\Models\Order;

class ActivationNotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.index', [
            'management' => 'service-activation',
            'page' => 'all-activations',
            'activationNotas' => ActivationNota::getAllActivationNotas(),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createProvisioning()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.create-provisioning', [
            'management' => 'service-activation',
            'page' => 'general',
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function createTechnicalData()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.create-technical-data', [
            'management' => 'service-activation',
            'page' => 'general',
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function createVerification()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.create-verification', [
            'management' => 'service-activation',
            'page' => 'general',
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivationNotaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivationNota $nota)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.show', [
            'management' => 'general',
            'page' => 'general',
            'nota' => $nota,
            'activation_status' => ActivationStatusHistory::getLatestStatusActivation($nota->id),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivationNota $activationNota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivationNotaRequest $request, ActivationNota $activationNota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivationNota $activationNota)
    {
        //
    }
}
