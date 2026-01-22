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
    public function createProvisioning(ActivationNota $nota)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.create-provisioning', [
            'management' => 'service-activation',
            'page' => 'general',
            'nota' => $nota,
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }

    public function storeProvisioning(Request $request, ActivationNota $nota)
    {
        $request->validate(
            [
                'ao' => ['required', 'string', 'max:50'],
                'sid' => ['required', 'string', 'max:50'],
                'pe' => ['required', 'string', 'max:50'],
                'interface' => ['required', 'string', 'max:50'],
                'ip_wan' => ['required', 'ip'],
                'ip_backhaul' => ['required', 'ip'],
                'hub_type' => ['required', 'in:Mangoesky,iDirect'],
                'nms_id' => ['required', 'string', 'max:50'],
                'create_nms_date' => ['required', 'date'],
                'ip_lan' => ['required', 'ip'],
                'subnet_mask_lan' => ['required', 'string', 'max:50'],
            ],
            [
                'ao.required' => 'AO wajib diisi.',
                'ao.max' => 'AO maksimal 50 karakter.',

                'sid.required' => 'SID wajib diisi.',
                'sid.max' => 'SID maksimal 50 karakter.',

                'pe.required' => 'PE wajib diisi.',
                'pe.max' => 'PE maksimal 50 karakter.',

                'interface.required' => 'Interface wajib diisi.',
                'interface.max' => 'Interface maksimal 50 karakter.',

                'ip_wan.required' => 'IP WAN wajib diisi.',
                'ip_wan.ip' => 'Format IP WAN tidak valid.',

                'ip_backhaul.required' => 'IP Backhaul wajib diisi.',
                'ip_backhaul.ip' => 'Format IP Backhaul tidak valid.',

                'hub_type.required' => 'Tipe HUB wajib dipilih.',
                'hub_type.in' => 'Tipe HUB harus Mangoesky atau iDirect.',

                'nms_id.required' => 'NMS ID wajib diisi.',
                'nms_id.max' => 'NMS ID maksimal 50 karakter.',

                'create_nms_date.required' => 'Tanggal pembuatan NMS wajib diisi.',
                'create_nms_date.date' => 'Format tanggal pembuatan NMS tidak valid.',

                'ip_lan.required' => 'IP LAN wajib diisi.',
                'ip_lan.ip' => 'Format IP LAN tidak valid.',

                'subnet_mask_lan.required' => 'Subnet Mask LAN wajib diisi.',
                'subnet_mask_lan.max' => 'Subnet Mask LAN maksimal 50 karakter.',
            ]
        );

        ActivationNota::storeProvisioning($nota->id, $request->all());

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Data provisioning berhasil disimpan.');
    }

    public function editProvisioning(ActivationNota $nota)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.edit-provisioning', [
            'management' => 'service-activation',
            'page' => 'general',
            'nota' => $nota,
            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }

    public function updateProvisioning(Request $request, ActivationNota $nota)
    {
        $request->validate(
            [
                'ao' => ['required', 'string', 'max:50'],
                'sid' => ['required', 'string', 'max:50'],
                'pe' => ['required', 'string', 'max:50'],
                'interface' => ['required', 'string', 'max:50'],
                'ip_wan' => ['required', 'ip'],
                'ip_backhaul' => ['required', 'ip'],
                'hub_type' => ['required', 'in:Mangoesky,iDirect'],
                'nms_id' => ['required', 'string', 'max:50'],
                'create_nms_date' => ['required', 'date'],
                'ip_lan' => ['required', 'ip'],
                'subnet_mask_lan' => ['required', 'string', 'max:50'],
            ],
            [
                'ao.required' => 'AO wajib diisi.',
                'ao.max' => 'AO maksimal 50 karakter.',

                'sid.required' => 'SID wajib diisi.',
                'sid.max' => 'SID maksimal 50 karakter.',

                'pe.required' => 'PE wajib diisi.',
                'pe.max' => 'PE maksimal 50 karakter.',

                'interface.required' => 'Interface wajib diisi.',
                'interface.max' => 'Interface maksimal 50 karakter.',

                'ip_wan.required' => 'IP WAN wajib diisi.',
                'ip_wan.ip' => 'Format IP WAN tidak valid.',

                'ip_backhaul.required' => 'IP Backhaul wajib diisi.',
                'ip_backhaul.ip' => 'Format IP Backhaul tidak valid.',

                'hub_type.required' => 'Tipe HUB wajib dipilih.',
                'hub_type.in' => 'Tipe HUB harus Mangoesky atau iDirect.',

                'nms_id.required' => 'NMS ID wajib diisi.',
                'nms_id.max' => 'NMS ID maksimal 50 karakter.',

                'create_nms_date.required' => 'Tanggal pembuatan NMS wajib diisi.',
                'create_nms_date.date' => 'Format tanggal pembuatan NMS tidak valid.',

                'ip_lan.required' => 'IP LAN wajib diisi.',
                'ip_lan.ip' => 'Format IP LAN tidak valid.',

                'subnet_mask_lan.required' => 'Subnet Mask LAN wajib diisi.',
                'subnet_mask_lan.max' => 'Subnet Mask LAN maksimal 50 karakter.',
            ]
        );

        ActivationNota::updateProvisioning($nota->id, $request->all());

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Data provisioning berhasil diperbarui.');
    }

    public function technicianOnTheWay(ActivationNota $nota)
    {
        ActivationNota::technicianOnTheWay($nota->id);

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Status teknisi dalam perjalanan berhasil diperbarui.');
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
