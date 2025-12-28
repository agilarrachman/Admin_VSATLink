<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
