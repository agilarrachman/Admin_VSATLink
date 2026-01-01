<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'unique_order';
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order_statuses()
    {
        return $this->belongsTo(OrderStatus::class, 'current_status_id');
    }

    public function order_status_histories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function order_contact()
    {
        return $this->belongsTo(OrderContact::class);
    }

    public function order_address()
    {
        return $this->belongsTo(OrderAddress::class);
    }

    public function activation_address()
    {
        return $this->belongsTo(ActivationAddress::class);
    }

    public function statusBadge(): array
    {
        return match ($this->current_status_id) {
            1 => [
                'label' => 'Menunggu Konfirmasi',
                'class' => 'bg-label-secondary',
            ],
            2 => [
                'label' => 'Pesanan Dikonfirmasi',
                'class' => 'bg-label-secondary',
            ],
            3 => [
                'label' => 'Belum Dibayar',
                'class' => 'bg-label-warning',
            ],
            7 => [
                'label' => 'Selesai',
                'class' => 'bg-label-success',
            ],
            8 => [
                'label' => 'Dibatalkan',
                'class' => 'bg-label-danger',
            ],
            default => [
                'label' => 'Sedang Diproses',
                'class' => 'bg-label-info',
            ],
        };
    }

    public static function getAllOrders()
    {
        return self::latest()
            ->get();
    }
    
    public static function getAllConfirmationOrders()
    {
        return self::where('current_status_id', 1)
            ->latest()
            ->get();
    }

    public static function unconfirmedOrdersCount()
    {
        return self::where('current_status_id', 1)
            ->count();
    }
}
