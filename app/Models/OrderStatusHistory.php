<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    /** @use HasFactory<\Database\Factories\OrderStatusHistoryFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public static function getLatestStatusOrder($order)
    {
        return self::where('order_id', $order)
            ->latest()
            ->first();
    }

    public static function canceledOrder($order)
    {
        return self::where('order_id', $order)
            ->where('order_status_id', 8)
            ->first();
    }
}
