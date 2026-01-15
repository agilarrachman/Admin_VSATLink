<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationStatus extends Model
{
    /** @use HasFactory<\Database\Factories\ActivationStatusFactory> */
    use HasFactory;

    public function activations()
    {
        return $this->hasMany(ActivationNota::class);
    }

    public function activation_status_histories()
    {
        return $this->hasMany(ActivationStatusHistory::class);
    }
}
