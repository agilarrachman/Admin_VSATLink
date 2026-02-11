<?php

namespace App\Http\Controllers;

use App\Models\ActivationNota;
use App\Models\ActivationStatusHistory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ActivationNotaController extends Controller
{
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
                'pe' => 'required|in:RTR-CONSUMER-7206-E1-B-BGR,RTR-ENTERPRISE-ASR1001-XE1-A-JKT',
                'interface' => 'required|string|max:255',
                'ip_interface' => 'required|unique:activation_notas,ip_interface',
                'ip_dns' => 'required|unique:activation_notas,ip_dns',
                'ip_backhaul' => 'required|in:IP Private,IP Public',
                'hub_type' => 'required|in:iDirect,Newtec,Hughes HX50,Hughes HX90,Hughes HX200,HTS MP2',
                'nms_id' => 'required|string|max:255|unique:activation_notas,nms_id',
                'create_nms_date' => 'required|date',
                'ip_lan' => 'required|unique:activation_notas,ip_lan',
                'subnet_mask_lan' => 'required|string|max:255',
            ],
            [
                'pe.required' => 'PE wajib diisi.',
                'pe.in' => 'PE harus salah satu dari: RTR-CONSUMER-7206-E1-B-BGR atau RTR-ENTERPRISE-ASR1001-XE1-A-JKT.',

                'interface.required' => 'Interface wajib diisi.',
                'interface.max' => 'Interface maksimal 50 karakter.',

                'ip_interface.required' => 'IP Interface wajib diisi.',
                'ip_interface.unique' => 'IP Interface sudah digunakan.',

                'ip_dns.required' => 'IP DNS wajib diisi.',
                'ip_dns.unique' => 'IP DNS sudah digunakan.',

                'ip_backhaul.required' => 'IP Backhaul wajib dipilih.',
                'ip_backhaul.in' => 'Tipe IP Backhaul harus salah satu dari: IP Private, IP Public.',

                'hub_type.required' => 'Tipe HUB wajib dipilih.',
                'hub_type.in' => 'Tipe HUB harus salah satu dari: iDirect, Newtec, Hughes HX50, Hughes HX90, Hughes HX200, HTS MP2.',

                'nms_id.required' => 'NMS ID wajib diisi.',
                'nms_id.max' => 'NMS ID maksimal 50 karakter.',
                'nms_id.unique' => 'NMS ID sudah digunakan.',

                'create_nms_date.required' => 'Tanggal pembuatan NMS wajib diisi.',
                'create_nms_date.date' => 'Format tanggal pembuatan NMS tidak valid.',

                'ip_lan.required' => 'IP LAN wajib diisi.',
                'ip_lan.unique' => 'IP LAN sudah digunakan.',

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
                'pe' => 'required|in:RTR-CONSUMER-7206-E1-B-BGR,RTR-ENTERPRISE-ASR1001-XE1-A-JKT',
                'interface' => 'required|string|max:255',
                'ip_interface' => 'required|unique:activation_notas,ip_interface,' . $nota->id,
                'ip_dns' => 'required|unique:activation_notas,ip_dns,' . $nota->id,
                'ip_backhaul' => 'required|in:IP Private,IP Public',
                'hub_type' => 'required|in:iDirect,Newtec,Hughes HX50,Hughes HX90,Hughes HX200,HTS MP2',
                'nms_id' => 'required|string|max:255|unique:activation_notas,nms_id,' . $nota->id,
                'create_nms_date' => 'required|date',
                'ip_lan' => 'required|unique:activation_notas,ip_lan,' . $nota->id,
                'subnet_mask_lan' => 'required|string|max:255',
            ],
            [
                'pe.required' => 'PE wajib diisi.',
                'pe.in' => 'PE harus salah satu dari: RTR-CONSUMER-7206-E1-B-BGR atau RTR-ENTERPRISE-ASR1001-XE1-A-JKT.',

                'interface.required' => 'Interface wajib diisi.',
                'interface.max' => 'Interface maksimal 50 karakter.',

                'ip_interface.required' => 'IP Interface wajib diisi.',
                'ip_interface.unique' => 'IP Interface sudah digunakan.',

                'ip_dns.required' => 'IP DNS wajib diisi.',
                'ip_dns.unique' => 'IP DNS sudah digunakan.',

                'ip_backhaul.required' => 'IP Backhaul wajib diisi.',
                'ip_backhaul.in' => 'Tipe IP Backhaul harus salah satu dari: IP Private, IP Public.',

                'hub_type.required' => 'Tipe HUB wajib dipilih.',
                'hub_type.in' => 'Tipe HUB harus salah satu dari: iDirect, Newtec, Hughes HX50, Hughes HX90, Hughes HX200, HTS MP2.',

                'nms_id.required' => 'NMS ID wajib diisi.',
                'nms_id.max' => 'NMS ID maksimal 50 karakter.',
                'nms_id.unique' => 'NMS ID sudah digunakan.',

                'create_nms_date.required' => 'Tanggal pembuatan NMS wajib diisi.',
                'create_nms_date.date' => 'Format tanggal pembuatan NMS tidak valid.',

                'ip_lan.required' => 'IP LAN wajib diisi.',
                'ip_lan.unique' => 'IP LAN sudah digunakan.',

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
            ->with('success', 'Status teknisi berhasil diperbarui menjadi dalam perjalanan.');
    }

    public function technicianArrived(ActivationNota $nota)
    {
        ActivationNota::technicianArrived($nota->id);

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Status teknisi berhasil diperbarui menjadi tiba di lokasi pelanggan.');
    }

    public function createTechnicalData(ActivationNota $nota)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.create-technical-data', [
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

    public function storeTechnicalData(Request $request, ActivationNota $nota)
    {
        $request->validate(
            [
                'sqf' => 'required|numeric|min:0',
                'esno' => 'required|numeric|min:0',
                'los' => 'required|in:Bersih,Terhalang',
                'antena_diameter' => 'required|in:0.7,1.2,1.8',
                'lft_id' => 'required|string|max:255',
                'cn' => 'required|numeric|min:0',
                'esn_modem' => 'required|string|max:255',
                'antena_type' => 'required|in:KU-BAND V61,KU-BAND V80',
                'technician_note' => 'nullable',
            ],
            [
                'sqf.required' => 'SQF wajib diisi.',
                'sqf.numeric'  => 'SQF harus berupa angka.',
                'sqf.min'      => 'SQF tidak boleh kurang dari 0.',

                'esno.required' => 'ESNO wajib diisi.',
                'esno.numeric'  => 'ESNO harus berupa angka.',
                'esno.min'      => 'ESNO tidak boleh bernilai negatif.',

                'los.required' => 'Line of Sight wajib dipilih.',
                'los.in'       => 'Line of Sight tidak valid.',

                'antena_diameter.required' => 'Diameter antena wajib dipilih.',
                'antena_diameter.in'       => 'Diameter antena tidak valid.',

                'lft_id.max' => 'ID LFT maksimal 50 karakter.',

                'cn.numeric' => 'C/N harus berupa angka.',
                'cn.min'     => 'C/N tidak boleh bernilai negatif.',

                'esn_modem.required' => 'ESN Modem wajib diisi.',
                'esn_modem.max'      => 'ESN Modem maksimal 50 karakter.',

                'antena_type.required' => 'Jenis antena wajib dipilih.',
                'antena_type.in'       => 'Jenis antena tidak valid.',
            ]
        );

        ActivationNota::storeTechnicalData($nota->id, $request->all());

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Data Teknis dan Crosspole berhasil disimpan.');
    }

    public function editTechnicalData(ActivationNota $nota)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.edit-technical-data', [
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

    public function updateTechnicalData(Request $request, ActivationNota $nota)
    {
        $request->validate(
            [
                'sqf' => 'required|numeric|min:0',
                'esno' => 'required|numeric|min:0',
                'los' => 'required|in:Bersih,Terhalang',
                'antena_diameter' => 'required|in:0.7,1.2,1.8',
                'lft_id' => 'required|string|max:255',
                'cn' => 'required|numeric|min:0',
                'esn_modem' => 'required|string|max:255',
                'antena_type' => 'required|in:KU-BAND V61,KU-BAND V80',
                'technician_note' => 'nullable',
            ],
            [
                'sqf.required' => 'SQF wajib diisi.',
                'sqf.numeric'  => 'SQF harus berupa angka.',
                'sqf.min'      => 'SQF tidak boleh kurang dari 0.',

                'esno.required' => 'ESNO wajib diisi.',
                'esno.numeric'  => 'ESNO harus berupa angka.',
                'esno.min'      => 'ESNO tidak boleh bernilai negatif.',

                'los.required' => 'Line of Sight wajib dipilih.',
                'los.in'       => 'Line of Sight tidak valid.',

                'antena_diameter.required' => 'Diameter antena wajib dipilih.',
                'antena_diameter.in'       => 'Diameter antena tidak valid.',

                'lft_id.max' => 'ID LFT maksimal 50 karakter.',

                'cn.numeric' => 'C/N harus berupa angka.',
                'cn.min'     => 'C/N tidak boleh bernilai negatif.',

                'esn_modem.required' => 'ESN Modem wajib diisi.',
                'esn_modem.max'      => 'ESN Modem maksimal 50 karakter.',

                'antena_type.required' => 'Jenis antena wajib dipilih.',
                'antena_type.in'       => 'Jenis antena tidak valid.',
            ]
        );

        ActivationNota::updateTechnicalData($nota->id, $request->all());

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Data Teknis dan Crosspole berhasil diperbarui.');
    }

    public function createVerification(ActivationNota $nota)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.create-verification', [
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

    public function storeVerification(Request $request, ActivationNota $nota)
    {
        $request->validate(
            [
                'monitoring_url' => 'required|url|max:255',
                'online_date' => 'nullable|date',
                'monitoring_capture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'monitoring_url.required' => 'URL Monitoring wajib diisi.',
                'monitoring_url.url' => 'Format URL Monitoring tidak valid.',

                'online_date.date' => 'Format tanggal & waktu online tidak valid.',

                'monitoring_capture.required' => 'Bukti monitoring wajib diunggah.',
                'monitoring_capture.image' => 'Bukti monitoring harus berupa gambar.',
                'monitoring_capture.mimes' => 'Format gambar harus JPG atau PNG.',
                'monitoring_capture.max' => 'Ukuran gambar maksimal 2MB.',
            ]
        );

        ActivationNota::storeVerification($nota->id, $request->all());

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Verifikasi aktivasi berhasil disimpan.');
    }

    public function editVerification(ActivationNota $nota)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('service-activations.edit-verification', [
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

    public function updateVerification(Request $request, ActivationNota $nota)
    {
        $request->validate(
            [
                'monitoring_url' => 'required|url|max:255',
                'online_date' => 'nullable|date',
                'monitoring_capture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'monitoring_url.required' => 'URL Monitoring wajib diisi.',
                'monitoring_url.url' => 'Format URL Monitoring tidak valid.',

                'online_date.date' => 'Format tanggal & waktu online tidak valid.',

                'monitoring_capture.image' => 'Bukti monitoring harus berupa gambar.',
                'monitoring_capture.mimes' => 'Format gambar harus JPG atau PNG.',
                'monitoring_capture.max' => 'Ukuran gambar maksimal 2MB.',
            ]
        );

        ActivationNota::updateVerification($nota->id, $request->all());

        return redirect('/service-activations/detail/' . $nota->id)
            ->with('success', 'Verifikasi aktivasi berhasil diperbarui.');
    }

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
        ]);

        $activationNota = ActivationNota::inputInstallationSchedule($request->activation_nota_id, $request->installation_date);

        $data = [
            'customer_name' => $activationNota->order->customer->name,
            'sales_name' => $activationNota->order->customer->sales->name,
            'sales_phone' => $activationNota->order->customer->sales->phone,
            'unique_order'  => $activationNota->order->unique_order,
            'product_name'  => $activationNota->order->product->name,
            'installation_date'  => $activationNota->installation_date->translatedFormat('d F Y'),
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
        ]);

        ActivationNota::editInstallationSchedule($request->activation_nota_id, $request->installation_date);

        return back()->with(
            'success',
            'Jadwal instalasi berhasil diperbarui.'
        );
    }

    public function downloadSPA(ActivationNota $nota)
    {
        $customerUrl = config('app.customer_url');
        $filename = basename($nota->activation_document_url);

        return redirect()->away(
            $customerUrl . '/download/spa/' . $filename
        );
    }
}
