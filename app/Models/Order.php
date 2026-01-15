<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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

        return $order;
    }

    public static function cancelOrder($user, $orderId, $reason)
    {
        $order = self::findOrFail($orderId);

        $order->current_status_id = 8;
        $order->save();

        OrderStatusHistory::create([
            'order_status_id' => 8,
            'order_id' => $order->id,
            'note' => "Pesanan {$order->unique_order} dibatalkan oleh " . $user->name . " dengan alasan: " . $reason,
        ]);

        return $order;
    }

    public static function storeSN($orderId, $modemSN, $adaptorSN, $bucSN, $lnbSN, $routerSN, $antenaSN)
    {
        $order = self::findOrFail($orderId);

        $order->update([
            'modem_sn' => $modemSN,
            'adaptor_sn' => $adaptorSN,
            'buc_sn' => $bucSN,
            'lnb_sn' => $lnbSN,
            'router_sn' => $routerSN,
            'antena_sn' => $antenaSN,
        ]);

        return $order;
    }

    public static function updateSN($orderId, $modemSN, $adaptorSN, $bucSN, $lnbSN, $routerSN, $antenaSN)
    {
        $order = self::findOrFail($orderId);

        $order->update([
            'modem_sn' => $modemSN,
            'adaptor_sn' => $adaptorSN,
            'buc_sn' => $bucSN,
            'lnb_sn' => $lnbSN,
            'router_sn' => $routerSN,
            'antena_sn' => $antenaSN,
        ]);

        return $order;
    }

    public static function getJneEta($order): ?array
    {
        if ($order->shipping !== 'JNE') {
            return null;
        }

        $response = Http::asForm()
            ->withOptions(['verify' => false])
            ->post(config('app.url_jne') . 'pricedev', [
                'username' => config('app.username_jne'),
                'api_key'  => config('app.api_key_jne'),
                'from'     => 'BOO10000',
                'thru'     => $order->order_address->village()->tariff_code,
                'weight'   => $order->product->device_weight ?? 1,
            ]);

        $prices = $response->json('price');

        $service = collect($prices)
            ->firstWhere('service_display', 'REG')
            ?? $prices[0];

        return [
            'from' => (int) $service['etd_from'],
            'thru' => (int) $service['etd_thru'],
            'service' => $service['service_display'],
        ];
    }

    public static function generatePackingListPdf($order): string
    {
        $pdf = Pdf::loadView('pdf.packing-list', [
            'order' => $order
        ]);

        $fileName = 'PACKING LIST-' . $order->unique_order . '.pdf';
        $databasePath = 'packing_lists/' . $fileName;

        Storage::disk('public')->put($databasePath, $pdf->output());

        return $databasePath;
    }

    public static function generateDeliveryNotePdf($order): string
    {
        $etaJne = self::getJneEta($order);

        $pdf = Pdf::loadView('pdf.delivery-note', [
            'order' => $order,
            'eta' => $etaJne
        ]);

        $fileName = 'DELIVERY NOTE-' . $order->unique_order . '.pdf';
        $databasePath = 'delivery_notes/' . $fileName;

        Storage::disk('public')->put($databasePath, $pdf->output());

        return $databasePath;
    }

    public static function requestPickup($orderId)
    {
        $order = self::findOrFail($orderId);

        do {
            $jneTrackingNumber = str_pad(
                random_int(0, 999999999999),
                12,
                '0',
                STR_PAD_LEFT
            );
        } while (
            self::where('jne_tracking_number', $jneTrackingNumber)->exists()
        );

        $currentMonthYear = now()->format('mY');

        $lastPackingList = self::where('packing_list_id', 'like', "PL.%/D4.200/LG300/{$currentMonthYear}/VSATLINK")
            ->orderBy('packing_list_id', 'desc')
            ->first();

        $sequenceNumber = 1;

        if ($lastPackingList) {
            preg_match('/PL\.(\d+)\//', $lastPackingList->packing_list_id, $matches);
            $sequenceNumber = ((int) $matches[1]) + 1;
        }

        $idPackingList = "PL.{$sequenceNumber}/D4.200/LG300/{$currentMonthYear}/VSATLINK";

        $order->update([
            'current_status_id'   => 5,
            'jne_tracking_number' => $jneTrackingNumber,
            'packing_list_id'     => $idPackingList,
        ]);

        $packingListUrl  = self::generatePackingListPdf($order->fresh());
        $deliveryNoteUrl = self::generateDeliveryNotePdf($order->fresh());

        $order->update([
            'packing_list_document_url'  => $packingListUrl,
            'delivery_note_document_url' => $deliveryNoteUrl,
        ]);

        OrderStatusHistory::create([
            'order_status_id' => 5,
            'order_id' => $order->id,
            'note' => "Permintaan pickup JNE untuk pesanan {$order->unique_order} telah dibuat.",
        ]);
    }

    public static function readyPickup($orderId)
    {
        $order = self::findOrFail($orderId);

        $currentMonthYear = now()->format('mY');

        $lastPackingList = self::where('packing_list_id', 'like', "PL.%/D4.200/LG300/{$currentMonthYear}/VSATLINK")
            ->orderBy('packing_list_id', 'desc')
            ->first();

        $sequenceNumber = 1;

        if ($lastPackingList) {
            preg_match('/PL\.(\d+)\//', $lastPackingList->packing_list_id, $matches);
            $sequenceNumber = ((int) $matches[1]) + 1;
        }

        $idPackingList = "PL.{$sequenceNumber}/D4.200/LG300/{$currentMonthYear}/VSATLINK";

        $order->update([
            'current_status_id'   => 6,
            'packing_list_id'     => $idPackingList,
        ]);

        $packingListUrl  = self::generatePackingListPdf($order->fresh());
        $deliveryNoteUrl = self::generateDeliveryNotePdf($order->fresh());

        $order->update([
            'packing_list_document_url'  => $packingListUrl,
            'delivery_note_document_url' => $deliveryNoteUrl,
        ]);

        OrderStatusHistory::create([
            'order_status_id' => 6,
            'order_id' => $order->id,
            'note' => "Pesanan {$order->unique_order} telah siap diambil customer.",
        ]);
    }

    public static function confirmPickup($orderId, $receiverName)
    {
        $order = self::findOrFail($orderId);

        $activationNota = ActivationNota::create([
            'current_status_id' => 1,
        ]);

        ActivationStatusHistory::create([
            'activation_status_id' => 1,
            'activation_nota_id' => $activationNota->id,
            'note' => "Pesanan {$order->unique_order} siap dilakukan penjadwalan instalasi dan aktivasi.",
        ]);

        $order->update([
            'activation_nota_id' => $activationNota->id,
            'current_status_id'  => 7,
        ]);

        $timestamp = Carbon::now()->translatedFormat('d F Y H:i');

        OrderStatusHistory::create([
            'order_status_id' => 7,
            'order_id' => $order->id,
            'note' => "Pesanan {$order->unique_order} telah diterima oleh {$receiverName} pada {$timestamp}.",
        ]);

        return $order;
    }
}
