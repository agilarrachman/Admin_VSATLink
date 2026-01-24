<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationStatusHistory extends Model
{
    /** @use HasFactory<\Database\Factories\ActivationStatusHistoryFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function activation()
    {
        return $this->belongsTo(ActivationNota::class);
    }

    public function activation_status()
    {
        return $this->belongsTo(ActivationStatus::class);
    }

    public static function getLatestStatusActivation($order)
    {
        return self::where('activation_nota_id', $order)
            ->latest()
            ->first();
    }
}
