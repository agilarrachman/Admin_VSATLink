<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $guarded = ['id'];

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
            4 => [
                'label' => 'Sudah Dibayar',
                'class' => 'bg-label-info',
            ],
            5 => [
                'label' => 'Dikirim',
                'class' => 'bg-label-info',
            ],
            6 => [
                'label' => 'Siap Diambil',
                'class' => 'bg-label-info',
            ],
            7 => [
                'label' => 'Diterima',
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

    public static function unconfirmedOrdersCount()
    {
        return self::where('current_status_id', 1)
            ->count();
    }

    public static function logisticsExpeditionPendingCount()
    {
        return self::where('current_status_id', 4)
            ->where('shipping', 'JNE')
            ->count();
    }
    
    public static function logisticsPickupPendingCount()
    {
        return self::where('current_status_id', 4)
            ->where('shipping', 'Ambil Ditempat')
            ->count();
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

    public static function getAllExpeditionOrders()
    {
        return self::whereIn('current_status_id', [4, 5, 6, 7])
            ->where('shipping', 'JNE')
            ->latest()
            ->get();
    }

    public static function getAllPickupOrders()
    {
        return self::whereIn('current_status_id', [4, 5, 6, 7])
            ->where('shipping', 'Ambil Ditempat')
            ->latest()
            ->get();
    }

    public static function confirmOrder($user, $orderId, $serviceCost, $transportCost)
    {
        $order = self::findOrFail($orderId);

        DB::transaction(function () use ($user, $order, $serviceCost, $transportCost) {
            $order->update([
                'installation_service_cost'   => $serviceCost,
                'installation_transport_cost' => $transportCost,
                'current_status_id'           => 2,
            ]);

            OrderStatusHistory::create([
                'order_status_id' => 2,
                'order_id' => $order->id,
                'note' => "Pesanan {$order->unique_order} dikonfirmasi oleh " . $user->name,
            ]);
        });

        return $order;
    }

    public static function cancelOrder($user, $orderId, $reason)
    {
        $order = self::findOrFail($orderId);

        DB::transaction(function () use ($user, $order, $reason) {
            $order->current_status_id = 8;
            $order->save();

            $orderStatusHistory = OrderStatusHistory::create([
                'order_status_id' => 8,
                'order_id' => $order->id,
                'note' => "Pesanan {$order->unique_order} dibatalkan oleh " . $user->name . " dengan alasan: " . $reason,
            ]);
        });

        return $order;
    }
}
