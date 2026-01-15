<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
                'label' => 'Sudah Dijadwalkan',
                'class' => 'bg-label-warning',
            ],
            3 => [
                'label' => 'Siap Instalasi',
                'class' => 'bg-label-info',
            ],
            4 => [
                'label' => 'Teknisi Dalam Perjalanan',
                'class' => 'bg-label-info',
            ],
            5 => [
                'label' => 'Teknisi Tiba Di Lokasi',
                'class' => 'bg-label-info',
            ],
            6 => [
                'label' => 'Request Aktivasi',
                'class' => 'bg-label-secondary',
            ],
            7 => [
                'label' => 'Aktivasi Terverifikasi',
                'class' => 'bg-label-success',
            ],
            8 => [
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
}
