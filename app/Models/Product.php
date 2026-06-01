<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function statistics()
    {
        return self::withCount([
            'orders as total' => function ($query) {
                $query->where('current_status_id', '!=', 8);
            }
        ])
            ->orderByDesc('total')
            ->get(['id', 'name', 'image_url']);
    }
}
