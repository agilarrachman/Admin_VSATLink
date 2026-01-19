<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\ActivationNota;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('orders.index', [
            'management' => 'orders',
            'page' => 'order-management',
            'orders' => Order::getAllOrders(),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }

    public function indexConfirmation()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('orders.confirmation', [
            'management' => 'orders',
            'page' => 'order-confirmation',
            'orders' => Order::getAllConfirmationOrders(),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('orders.show', [
            'management' => 'general',
            'page' => 'general',
            'order' => $order,
            'order_status' => OrderStatusHistory::getLatestStatusOrder($order->id),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }

    public function data(Order $order)
    {
        $product = $order->product()->first();
        $activation_address = $order->activation_address()->first();

        return response()->json([
            'order' => [
                'id' => $order->id,
                'unique_order' => $order->unique_order,
                'product_image' => $product->image_url,
                'product_name' => $product->name,
                'product_cost' => 'Rp' . number_format($order->product_cost, 0, ',', '.'),
                'created_at' => $order->created_at->translatedFormat('d F Y, H:i'),
                'withRouter' => $order->product->access_point ? true : false,
            ],
            'address' => [
                'google_maps_url' => $activation_address->google_maps_url,
                'latitude' => $activation_address->latitude,
                'longitude' => $activation_address->longitude,
            ],
            'serial_number' => [
                'modem_sn' => $order->modem_sn,
                'adaptor_sn' => $order->adaptor_sn,
                'buc_sn' => $order->buc_sn,
                'lnb_sn' => $order->lnb_sn,
                'router_sn' => $order->router_sn,
                'antena_sn' => $order->antena_sn,
            ],
        ]);
    }

    public function customerShow(Order $order)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('orders.customer', [
            'management' => 'general',
            'page' => 'general',
            'order' => $order,

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
            'activationSchedulePendingCount' => ActivationNota::activationSchedulePendingCount(),
        ]);
    }

    public function customerData(Order $order)
    {
        $customer = $order->customer()->with('sales')->first();

        return response()->json([
            'customer' => [
                'customer_type' => $customer->customer_type,
                'username' => $customer->username,
                'name' => $customer->name,
                'company_representative_name' => $customer->company_representative_name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'npwp' => $customer->npwp,
                'full_address' => $customer->full_address,
                'sales' => $customer->sales?->name,
                'source_information' => $customer->source_information,
            ],
            'address' => [
                'province' => $customer->province()->name,
                'city' => $customer->city()->name,
                'district' => $customer->district()->name,
                'village' => $customer->village()->name,
                'rt' => $customer->rt,
                'rw' => $customer->rw,
                'postal_code' => $customer->postal_code,
                'full_address' => $customer->full_address,
            ],
            'contact' => $customer->customer_type !== 'Perorangan' ? [
                'contact_name' => $customer->contact_name,
                'contact_email' => $customer->contact_email,
                'contact_phone' => $customer->contact_phone,
                'contact_position' => $customer->contact_position,
            ] : null,
        ]);
    }

    public function npwpDownload(Order $order)
    {
        $customer = $order->customer()->first();
        $customerUrl = config('app.customer_url');
        $filename = basename($customer->npwp_document_url);

        return redirect()->away(
            $customerUrl . '/download/dokumen/' . $filename
        );
    }

    public function nibDownload(Order $order)
    {
        $customer = $order->customer()->first();
        $customerUrl = config('app.customer_url');
        $filename = basename($customer->nib_document_url);

        return redirect()->away(
            $customerUrl . '/download/dokumen/' . $filename
        );
    }

    public function skDownload(Order $order)
    {
        $customer = $order->customer()->first();
        $customerUrl = config('app.customer_url');
        $filename = basename($customer->sk_document_url);

        return redirect()->away(
            $customerUrl . '/download/dokumen/' . $filename
        );
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'service_cost' => 'required|numeric',
            'transport_cost' => 'required|numeric',
        ]);

        $order = Order::confirmOrder(Auth::user(), $request->order_id, $request->service_cost, $request->transport_cost);

        $data = [
            'customer_name' => $order->customer->name,
            'sales_name' => $order->customer->sales->name,
            'sales_phone' => $order->customer->sales->phone,
            'unique_order'  => $order->unique_order,
            'product_name'  => $order->product->name,
            'installation_service_cost'  => $order->installation_service_cost,
            'installation_transport_cost'  => $order->installation_transport_cost,
            'updated_date' => $order->updated_at->translatedFormat('d F Y H:i'),
        ];

        $customerEmail = $order->customer->email;

        Mail::send('emails.order-confirmed', $data, function ($message) use ($customerEmail) {
            $message->to($customerEmail)
                ->subject('[NOTIFIKASI] Pesanan Anda Telah Dikonfirmasi');
        });

        if ($order->customer->customer_type !== 'Perorangan' && $order->customer->contact_email) {
            Mail::send('emails.order-confirmed', $data, function ($message) use ($order) {
                $message->to($order->customer->contact_email)
                    ->subject('[NOTIFIKASI] Pesanan Anda Telah Dikonfirmasi');
            });
        }

        return back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required',
        ]);

        $order = Order::cancelOrder(Auth::user(), $request->order_id, $request->reason);
        $history = OrderStatusHistory::canceledOrder($order->id);

        $data = [
            'customer_name' => $order->customer->name,
            'sales_name' => $order->customer->sales->name,
            'sales_phone' => $order->customer->sales->phone,
            'unique_order'  => $order->unique_order,
            'product_name'  => $order->product->name,
            'reason'  => $history->note,
            'updated_date' => $order->updated_at->translatedFormat('d F Y H:i'),
        ];

        $customerEmail = $order->customer->email;

        Mail::send('emails.order-canceled', $data, function ($message) use ($customerEmail) {
            $message->to($customerEmail)
                ->subject('[NOTIFIKASI] Pesanan Anda Telah Dibatalkan');
        });

        if ($order->customer->customer_type !== 'Perorangan' && $order->customer->contact_email) {
            Mail::send('emails.order-canceled', $data, function ($message) use ($order) {
                $message->to($order->customer->contact_email)
                    ->subject('[NOTIFIKASI] Pesanan Anda Telah Dibatalkan');
            });
        }

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function downloadInvoice(Order $order)
    {
        $customerUrl = config('app.customer_url');
        $filename = basename($order->invoice_document_url);

        return redirect()->away(
            $customerUrl . '/download/invoice/' . $filename
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
