<?php

namespace App\Http\Controllers;

use App\Models\ActivationNota;
use App\Models\ActivationStatusHistory;
use App\Models\Order;
use Illuminate\Http\Request;

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
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
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
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
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
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
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
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
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
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }

    public function inputInstallationSchedule(Request $request)
    {
        $request->validate([
            'activation_nota_id' => 'required|exists:activation_notas,id',
            'installation_date' => 'required',
            'installation_session' => 'required|in:Pagi,Siang',
        ]);

        ActivationNota::inputInstallationSchedule($request->activation_nota_id, $request->installation_date, $request->installation_session);

        return back()->with(
            'success',
            'Jadwal instalasi berhasil diajukan dan menunggu konfirmasi.'
        );
    }

    public function editInstallationSchedule(Request $request)
    {
        $request->validate([
            'activation_nota_id' => 'required|exists:activation_notas,id',
            'installation_date' => 'required',
            'installation_session' => 'required|in:Pagi,Siang',
        ]);

        ActivationNota::editInstallationSchedule($request->activation_nota_id, $request->installation_date, $request->installation_session);

        return back()->with(
            'success',
            'Jadwal instalasi berhasil diperbarui.'
        );
    }
}
