<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    public function sales()
    {
        return $this->belongsTo(Admin::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function province()
    {
        return DB::table('provinces')
            ->where('id', $this->province_id)
            ->first();
    }

    public function city()
    {
        return DB::table('cities')
            ->where('id', $this->city_id)
            ->first();
    }

    public function district()
    {
        return DB::table('districts')
            ->where('id', $this->district_id)
            ->first();
    }

    public function village()
    {
        return DB::table('villages')
            ->where('id', $this->village_id)
            ->first();
    }
}
