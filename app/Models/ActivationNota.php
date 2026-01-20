<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ActivationNota extends Model
{
    /** @use HasFactory<\Database\Factories\ActivationNotaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'installation_date' => 'datetime',
        'online_date' => 'datetime',
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
                'class' => 'bg-label-danger',
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
        return self::where('current_status_id', 1)
            ->count();
    }

    public static function inputInstallationSchedule($activationNotaId, $installationDate, $installationSession)
    {
        $activationNota = self::findOrFail($activationNotaId);        

        $activationNota->update([
            'current_status_id'  => 2,
            'installation_date' => $installationDate,
            'installation_session' => $installationSession,
        ]);

        $timeRange = $installationSession === 'Pagi' ? '08.00 - 11.00' : '13.00 - 17.00';

        ActivationStatusHistory::create([
            'activation_status_id' => 2,
            'activation_nota_id'   => $activationNota->id,
            'note' => 'Jadwal instalasi diajukan pada '
                . Carbon::parse($installationDate)->translatedFormat('d F Y')
                . ' (' . $installationSession . ', ' . $timeRange . ')',
        ]);

        return $activationNota;
    }
}
