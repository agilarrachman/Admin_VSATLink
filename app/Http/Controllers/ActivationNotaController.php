<?php

namespace App\Http\Controllers;

use App\Models\ActivationNota;
use App\Models\ActivationStatusHistory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $activationNota = ActivationNota::inputInstallationSchedule($request->activation_nota_id, $request->installation_date, $request->installation_session);

        $data = [
            'customer_name' => $activationNota->order->customer->name,
            'sales_name' => $activationNota->order->customer->sales->name,
            'sales_phone' => $activationNota->order->customer->sales->phone,
            'unique_order'  => $activationNota->order->unique_order,
            'product_name'  => $activationNota->order->product->name,
            'installation_date'  => $activationNota->installation_date->translatedFormat('d F Y'),
            'installation_session'  => $activationNota->installation_session === 'Pagi' ? 'Pagi (08.00-11.00)' : 'Siang (13.00-17.00)',
        ];

        $customerEmail = $activationNota->order->customer->email;

        Mail::send('emails.installation-scheduled', $data, function ($message) use ($customerEmail) {
            $message->to($customerEmail)
                ->subject('[NOTIFIKASI] Jadwal Instalasi & Aktivasi Pesanan Anda');
        });

        if ($activationNota->order->customer->customer_type !== 'Perorangan' && $activationNota->order->customer->contact_email) {
            Mail::send('emails.installation-scheduled', $data, function ($message) use ($activationNota) {
                $message->to($activationNota->order->customer->contact_email)
                    ->subject('[NOTIFIKASI] Jadwal Instalasi & Aktivasi Pesanan Anda');
            });
        }

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
