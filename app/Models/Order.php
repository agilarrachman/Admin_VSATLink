<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'payment_date' => 'datetime',
    ];

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

    public function activation_nota()
    {
        return $this->belongsTo(ActivationNota::class);
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

    public static function totalRevenue()
    {
        return self::sum('total_cost');
    }

    public static function totalActiveOrders()
    {
        return self::whereIn('current_status_id', [1, 2, 3, 4, 5, 6])->count();
    }

    public static function totalOrders()
    {
        return self::count();
    }

    public static function monthlyRevenueChart()
    {
        $monthlyRevenueRaw = self::select(
            DB::raw('MONTH(payment_date) as month'),
            DB::raw('SUM(total_cost) as total')
        )
            ->where('payment_success', true)
            ->whereYear('payment_date', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyRevenue = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[] = $monthlyRevenueRaw[$i] ?? 0;
        }

        return $monthlyRevenue;
    }

    public static function monthlyRevenueComparison()
    {
        $currentMonthRevenue = self::where('payment_success', true)
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('total_cost');

        $lastMonthRevenue = self::where('payment_success', true)
            ->whereMonth('payment_date', now()->copy()->subMonth()->month)
            ->whereYear('payment_date', now()->copy()->subMonth()->year)
            ->sum('total_cost');

        $difference = $currentMonthRevenue - $lastMonthRevenue;

        $percentage = 0;

        if ($lastMonthRevenue > 0) {
            $percentage = ($difference / $lastMonthRevenue) * 100;
        }

        return [
            'current' => $currentMonthRevenue,
            'last' => $lastMonthRevenue,
            'difference' => $difference,
            'percentage' => round($percentage, 1),
        ];
    }

    public static function weeklyRevenueChart()
    {
        $weeklyRevenue = [];
        $weeklyCategories = [];

        for ($i = 4; $i >= 0; $i--) {

            $startOfWeek = now()->copy()->subWeeks($i)->startOfWeek();
            $endOfWeek   = now()->copy()->subWeeks($i)->endOfWeek();

            $total = self::where('payment_success', true)
                ->whereBetween('payment_date', [$startOfWeek, $endOfWeek])
                ->sum('total_cost');

            $weeklyRevenue[] = $total;

            $weeklyCategories[] =
                $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M');
        }

        return [
            'revenue' => $weeklyRevenue,
            'categories' => $weeklyCategories,
        ];
    }

    public static function weeklyRevenueComparison()
    {
        $currentWeekRevenue = self::where('payment_success', true)
            ->whereBetween('payment_date', [
                now()->copy()->startOfWeek(),
                now()->copy()->endOfWeek()
            ])
            ->sum('total_cost');

        $lastWeekRevenue = self::where('payment_success', true)
            ->whereBetween('payment_date', [
                now()->copy()->subWeek()->startOfWeek(),
                now()->copy()->subWeek()->endOfWeek()
            ])
            ->sum('total_cost');

        $difference = $currentWeekRevenue - $lastWeekRevenue;

        $percentage = 0;

        if ($lastWeekRevenue > 0) {
            $percentage = ($difference / $lastWeekRevenue) * 100;
        } elseif ($currentWeekRevenue > 0) {
            $percentage = ($difference / $currentWeekRevenue) * 100;
        }

        return [
            'current' => $currentWeekRevenue,
            'last' => $lastWeekRevenue,
            'difference' => $difference,
            'percentage' => round($percentage, 1),
        ];
    }

    public static function dailyRevenueChart()
    {
        $dailyRevenueRaw = self::select(
            DB::raw('DATE(payment_date) as date'),
            DB::raw('SUM(total_cost) as total')
        )
            ->where('payment_success', true)
            ->whereDate('payment_date', '>=', now()->subDays(6))
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $dailyRevenue = [];
        $dailyCategories = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = now()->copy()->subDays($i);

            $formattedDate = $date->format('Y-m-d');

            $dailyRevenue[] = $dailyRevenueRaw[$formattedDate] ?? 0;

            $dailyCategories[] = $date->format('d M Y');
        }

        return [
            'revenue' => $dailyRevenue,
            'categories' => $dailyCategories,
        ];
    }

    public static function dailyRevenueComparison()
    {
        $currentDayRevenue = self::where('payment_success', true)
            ->whereDate('payment_date', now()->toDateString())
            ->sum('total_cost');

        $lastDayRevenue = self::where('payment_success', true)
            ->whereDate('payment_date', now()->copy()->subDay()->toDateString())
            ->sum('total_cost');

        $difference = $currentDayRevenue - $lastDayRevenue;

        $percentage = 0;

        if ($lastDayRevenue > 0) {
            $percentage = ($difference / $lastDayRevenue) * 100;
        } elseif ($currentDayRevenue > 0) {
            $percentage = ($difference / $currentDayRevenue) * 100;
        }

        return [
            'current' => $currentDayRevenue,
            'last' => $lastDayRevenue,
            'difference' => $difference,
            'percentage' => round($percentage, 1),
        ];
    }

    public static function activationLocations()
    {
        return self::join(
            'activation_addresses',
            'orders.activation_address_id',
            '=',
            'activation_addresses.id'
        )
            ->whereNotNull('activation_addresses.latitude')
            ->whereNotNull('activation_addresses.longitude')
            ->select(
                'orders.unique_order',
                'orders.total_cost',
                'activation_addresses.latitude',
                'activation_addresses.longitude',
                'activation_addresses.google_maps_url'
            )
            ->get()
            ->groupBy(function ($item) {
                return $item->latitude . ',' . $item->longitude;
            })
            ->map(function ($group) {

                return [
                    'latitude'         => $group->first()->latitude,
                    'longitude'        => $group->first()->longitude,
                    'google_maps_url'  => $group->first()->google_maps_url,

                    'total_orders'     => $group->count(),

                    'total_revenue'    => $group->sum('total_cost'),

                    'unique_orders'    => $group->pluck('unique_order')->implode(', ')
                ];
            })
            ->values();
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

    public static function requestPickup($orderId, $etdThru)
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
            'estimated_arrival_date' => Carbon::now()->addDays((int) $etdThru)->toDateString(),
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
            'note' => "Permintaan pickup JNE untuk pesanan {$order->unique_order} telah dibuat dan diperkirakan tiba pada tanggal {$order->estimated_arrival_date}.",
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

        $dataOrder = [
            'order' => $order,
            'received_date' => $timestamp,
        ];

        $installationCoordinatorEmails = Admin::getAllInstallationCoordinatorEmail();

        Mail::send('emails.order-received', $dataOrder, function ($message) use ($installationCoordinatorEmails) {
            $message->to($installationCoordinatorEmails)
                ->subject('[NOTIFIKASI] Pesanan Telah Diterima Customer');
        });;

        return $order;
    }
}
