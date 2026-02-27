<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ActivationNota extends Model
{
    /** @use HasFactory<\Database\Factories\ActivationNotaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'installation_date' => 'datetime',
        'online_date' => 'datetime',
        'create_nms_date' => 'datetime',
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }


    public function activation_statuses()
    {
        return $this->belongsTo(ActivationStatus::class, 'current_status_id');
    }

    public function activation_status_histories()
    {
        return $this->hasMany(ActivationStatusHistory::class);
    }

    public function statusBadge(): array
    {
        return match ($this->current_status_id) {
            1 => [
                'label' => 'Belum Dijadwalkan',
                'class' => 'bg-label-danger',
            ],
            2 => [
                'label'  => 'Menunggu Konfirmasi',
                'class' => 'bg-label-danger',
            ],
            3 => [
                'label' => 'Jadwal Ditolak',
                'class' => 'bg-label-danger',
            ],
            4 => [
                'label' => 'Jadwal Dikonfirmasi',
                'class' => 'bg-label-warning',
            ],
            5 => [
                'label' => 'Siap Instalasi',
                'class' => 'bg-label-info',
            ],
            6 => [
                'label' => 'Teknisi Dalam Perjalanan',
                'class' => 'bg-label-info',
            ],
            7 => [
                'label' => 'Teknisi Tiba Di Lokasi',
                'class' => 'bg-label-info',
            ],
            8 => [
                'label' => 'Request Aktivasi',
                'class' => 'bg-label-secondary',
            ],
            9 => [
                'label' => 'Aktivasi Terverifikasi',
                'class' => 'bg-label-success',
            ],
            10 => [
                'label' => 'SPA Ditandatangani',
                'class' => 'bg-label-success',
            ]
        };
    }

    public static function getAllActivationNotas()
    {
        return self::latest()
            ->get();
    }

    public static function activationSchedulePendingCount()
    {
        return self::whereIn('current_status_id', [1, 3])
            ->count();
    }

    public static function inputInstallationSchedule($activationNotaId, $installationDate)
    {
        $activationNota = self::findOrFail($activationNotaId);

        $activationNota->update([
            'current_status_id'  => 2,
            'installation_date' => $installationDate,
        ]);

        ActivationStatusHistory::create([
            'activation_status_id' => 2,
            'activation_nota_id'   => $activationNota->id,
            'note' => 'Jadwal instalasi diajukan pada '
                . Carbon::parse($installationDate)->translatedFormat('d F Y'),
        ]);

        return $activationNota;
    }

    public static function editInstallationSchedule($activationNotaId, $installationDate)
    {
        $activationNota = self::findOrFail($activationNotaId);

        if ($activationNota->current_status_id == 3) {
            $updateData['current_status_id'] = 4;
        }

        $activationNota->update([
            'installation_date' => $installationDate,
        ]);

        if ($activationNota->current_status_id == 3) {
            ActivationStatusHistory::create([
                'activation_status_id' => 4,
                'activation_nota_id'   => $activationNota->id,
                'note' => 'Jadwal instalasi diperbarui menjadi pada '
                    . Carbon::parse($installationDate)->translatedFormat('d F Y'),
            ]);
        }

        return $activationNota;
    }

    public static function storeProvisioning($activationNotaId, $requestData)
    {
        DB::beginTransaction();

        try {
            $activationNota = self::findOrFail($activationNotaId);

            $activationNota->update([
                'current_status_id' => 5,
                'pe' => $requestData['pe'] ?? null,
                'interface' => $requestData['interface'] ?? null,
                'ip_interface' => $requestData['ip_interface'] ?? null,
                'ip_dns' => $requestData['ip_dns'] ?? null,
                'ip_backhaul' => $requestData['ip_backhaul'] ?? null,
                'hub_type' => $requestData['hub_type'] ?? null,
                'nms_id' => $requestData['nms_id'] ?? null,
                'create_nms_date' => $requestData['create_nms_date'] ?? null,
                'ip_lan' => $requestData['ip_lan'] ?? null,
                'subnet_mask_lan' => $requestData['subnet_mask_lan'] ?? null,
            ]);

            ActivationStatusHistory::create([
                'activation_status_id' => 5,
                'activation_nota_id'   => $activationNota->id,
                'note' => 'Data provisioning telah diinput dan proses perjalanan teknisi dapat dimulai.'
            ]);

            DB::commit();

            return $activationNota;
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Gagal store provisioning', [
                'activation_nota_id' => $activationNotaId,
                'error_message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            throw $e; // biar controller bisa handle juga
        }
    }

    public static function updateProvisioning($activationNotaId, $requestData)
    {
        $activationNota = self::findOrFail($activationNotaId);

        $activationNota->update([

            'pe' => $requestData['pe'],
            'interface' => $requestData['interface'],
            'ip_interface' => $requestData['ip_interface'],
            'ip_dns' => $requestData['ip_dns'],
            'ip_backhaul' => $requestData['ip_backhaul'],
            'hub_type' => $requestData['hub_type'],
            'nms_id' => $requestData['nms_id'],
            'create_nms_date' => $requestData['create_nms_date'],
            'ip_lan' => $requestData['ip_lan'],
            'subnet_mask_lan' => $requestData['subnet_mask_lan'],
        ]);

        return $activationNota;
    }

    public static function technicianOnTheWay($activationNotaId)
    {
        $activationNota = self::findOrFail($activationNotaId);

        $activationNota->update([
            'current_status_id'  => 6,
        ]);

        $timestamp = Carbon::now()->translatedFormat('d F Y H:i');

        ActivationStatusHistory::create([
            'activation_status_id' => 6,
            'activation_nota_id' => $activationNota->id,
            'note' => "Teknisi telah memulai perjalanan menuju lokasi pelanggan pada {$timestamp}.",
        ]);

        return $activationNota;
    }

    public static function technicianArrived($activationNotaId)
    {
        $activationNota = self::findOrFail($activationNotaId);

        $activationNota->update([
            'current_status_id'  => 7,
        ]);

        $timestamp = Carbon::now()->translatedFormat('d F Y H:i');

        ActivationStatusHistory::create([
            'activation_status_id' => 7,
            'activation_nota_id' => $activationNota->id,
            'note' => "Teknisi telah tiba di lokasi pelanggan pada {$timestamp}.",
        ]);

        return $activationNota;
    }

    public static function storeTechnicalData($activationNotaId, $requestData)
    {
        $activationNota = self::findOrFail($activationNotaId);
        $path = $requestData['ping_capture']->store('ping_captures', 'public');

        $activationNota->update([
            'current_status_id'  => 8,
            'sqf' => $requestData['sqf'],
            'esno' => $requestData['esno'],
            'los' => $requestData['los'],
            'antena_diameter' => $requestData['antena_diameter'],
            'lft_id' => $requestData['lft_id'],
            'cn' => $requestData['cn'],
            'esn_modem' => $requestData['esn_modem'],
            'antena_type' => $requestData['antena_type'],
            'ping_capture_url' => $path,
            'technician_note' => $requestData['technician_note'] ?? null,
        ]);

        ActivationStatusHistory::create([
            'activation_status_id' => 8,
            'activation_nota_id'   => $activationNota->id,
            'note' => 'Data teknis telah diinput dan permintaan aktivasi telah diajukan.'
        ]);

        return $activationNota;
    }

    public static function updateTechnicalData($activationNotaId, $requestData)
    {
        $activationNota = self::findOrFail($activationNotaId);

        $updateData = [
            'current_status_id'  => 8,
            'sqf' => $requestData['sqf'],
            'esno' => $requestData['esno'],
            'los' => $requestData['los'],
            'antena_diameter' => $requestData['antena_diameter'],
            'lft_id' => $requestData['lft_id'],
            'cn' => $requestData['cn'],
            'esn_modem' => $requestData['esn_modem'],
            'antena_type' => $requestData['antena_type'],
            'technician_note' => $requestData['technician_note'] ?? null,
        ];

        if (isset($requestData['ping_capture'])) {
            Storage::disk('public')->delete($activationNota->ping_capture_url);

            $path = $requestData['ping_capture']
                ->store('ping_captures', 'public');

            $updateData['ping_capture_url'] = $path;
        }

        $activationNota->update($updateData);

        return $activationNota;
    }

    public static function storeVerification($activationNotaId, $requestData)
    {
        $activationNota = self::findOrFail($activationNotaId);
        $path = $requestData['monitoring_capture']->store('monitoring_captures', 'public');

        $activationNota->update([
            'monitoring_url' => $requestData['monitoring_url'],
            'online_date' => $requestData['online_date'] ?? null,
            'monitoring_capture_url' => $path,
        ]);

        $activationNota->update([
            'current_status_id'  => 9
        ]);

        ActivationStatusHistory::create([
            'activation_status_id' => 9,
            'activation_nota_id'   => $activationNota->id,
            'note' => 'Aktivasi layanan telah diverifikasi dan dinyatakan aktif.'
        ]);

        return $activationNota;
    }

    public static function updateVerification($activationNotaId, $requestData)
    {
        $activationNota = self::findOrFail($activationNotaId);

        $updateData = [
            'monitoring_url'     => $requestData['monitoring_url'],
            'online_date'   => $requestData['online_date'] ?? null,
        ];

        if (isset($requestData['monitoring_capture'])) {
            Storage::disk('public')->delete($activationNota->monitoring_capture_url);

            $path = $requestData['monitoring_capture']
                ->store('monitoring_captures', 'public');

            $updateData['monitoring_capture_url'] = $path;
        }

        $activationNota->update($updateData);

        $timestamp = Carbon::now()->translatedFormat('d F Y H:i');

        $activationNota->update([
            'current_status_id'  => 9
        ]);

        ActivationStatusHistory::create([
            'activation_status_id' => 9,
            'activation_nota_id'   => $activationNota->id,
            'note' => "Aktivasi layanan telah diverifikasi dan dinyatakan aktif pada {$timestamp}."
        ]);

        return $activationNota;
    }
}
