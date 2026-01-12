<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexExpedition()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.index-expedition', [
            'management' => 'logistics',
            'page' => 'logistic-expedition',
            'orders' => Order::getAllExpeditionOrders(),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function indexPickup()
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.index-pickup', [
            'management' => 'logistics',
            'page' => 'logistic-pickup',
            'orders' => Order::getAllPickupOrders(),

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function inputSN(Order $order)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.input-sn', [
            'management' => 'general',
            'page' => 'general',
            'order' => $order,

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function storeSN(Request $request, Order $order)
    {
        $request->validate(
            [
                'modem_sn'   => 'required|min:6|max:20|unique:orders,modem_sn',
                'adaptor_sn' => 'required|min:6|max:20|unique:orders,adaptor_sn',
                'buc_sn'     => 'required|min:6|max:20|unique:orders,buc_sn',
                'lnb_sn'     => 'required|min:6|max:20|unique:orders,lnb_sn',
                'router_sn'  => 'nullable|min:6|max:20|unique:orders,router_sn',
                'antena_sn'  => 'required|min:6|max:20|unique:orders,antena_sn',
            ],
            [
                '*.unique'   => 'Serial number sudah digunakan.',
                '*.required' => 'Serial number wajib diisi.',
                '*.min'      => 'Serial number minimal :min karakter.',
                '*.max'      => 'Serial number maksimal :max karakter.',
            ]
        );

        Order::storeSN($order->id, $request->modem_sn, $request->adaptor_sn, $request->buc_sn, $request->lnb_sn, $request->router_sn, $request->antena_sn,);

        if ($order->shipping === 'JNE') {
            return redirect('/logistics/expedition')->with('success', 'Serial number perangkat berhasil disimpan.');
        }

        if ($order->shipping === 'Ambil Ditempat') {
            return redirect('/logistics/pickup')->with('success', 'Serial number perangkat berhasil disimpan.');
        }
    }

    public function editSN(Order $order)
    {
        $logisticsExpeditionPendingCount = Order::logisticsExpeditionPendingCount();
        $logisticsPickupPendingCount     = Order::logisticsPickupPendingCount();

        return view('logistics.edit-sn', [
            'management' => 'general',
            'page' => 'general',
            'order' => $order,

            'unconfirmedOrdersCount' => Order::unconfirmedOrdersCount(),
            'logisticsPendingTotal'    => $logisticsExpeditionPendingCount + $logisticsPickupPendingCount,
            'logisticsExpeditionPendingCount' => $logisticsExpeditionPendingCount,
            'logisticsPickupPendingCount'     => $logisticsPickupPendingCount,
        ]);
    }

    public function updateSN(Request $request, Order $order)
    {
        $request->validate(
            [
                'modem_sn'   => 'required|min:6|max:20|unique:orders,modem_sn,' . $order->id,
                'adaptor_sn' => 'required|min:6|max:20|unique:orders,adaptor_sn,' . $order->id,
                'buc_sn'     => 'required|min:6|max:20|unique:orders,buc_sn,' . $order->id,
                'lnb_sn'     => 'required|min:6|max:20|unique:orders,lnb_sn,' . $order->id,
                'router_sn'  => 'nullable|min:6|max:20|unique:orders,router_sn,' . $order->id,
                'antena_sn'  => 'required|min:6|max:20|unique:orders,antena_sn,' . $order->id,
            ],
            [
                '*.unique'   => 'Serial number sudah digunakan.',
                '*.required' => 'Serial number wajib diisi.',
                '*.min'      => 'Serial number minimal :min karakter.',
                '*.max'      => 'Serial number maksimal :max karakter.',
            ]
        );

        Order::updateSN($order->id, $request->modem_sn, $request->adaptor_sn, $request->buc_sn, $request->lnb_sn, $request->router_sn, $request->antena_sn,);

        if ($order->shipping === 'JNE') {
            return redirect('/logistics/expedition')->with('success', 'Serial number perangkat berhasil diperbarui.');
        }

        if ($order->shipping === 'Ambil Ditempat') {
            return redirect('/logistics/pickup')->with('success', 'Serial number perangkat berhasil diperbarui.');
        }
    }

    public function requestPickup(Order $order)
    {
        Order::requestPickup($order->id);

        return redirect('/logistics/expedition')->with('success', 'Permintaan pickup ke ekspedisi berhasil dibuat dan dokumen logistik telah digenerate.');
    }

    public function readyPickup(Order $order)
    {
        Order::readyPickup($order->id);
        $order->refresh();

        $data = [
            'customer_name' => $order->customer->name,
            'sales_name' => $order->customer->sales->name,
            'sales_phone' => $order->customer->sales->phone,
            'unique_order'  => $order->unique_order,
            'product_name'  => $order->product->name,
            'updated_date' => $order->updated_at->translatedFormat('d F Y H:i'),
        ];

        $customerEmail = $order->customer->email;

        Mail::send('emails.ready-pickup', $data, function ($message) use ($customerEmail) {
            $message->to($customerEmail)
                ->subject('[NOTIFIKASI] Pesanan Anda Siap Diambil');
        });

        if ($order->customer->customer_type !== 'Perorangan' && $order->customer->contact_email) {
            Mail::send('emails.ready-pickup', $data, function ($message) use ($order) {
                $message->to($order->customer->contact_email)
                    ->subject('[NOTIFIKASI] Pesanan Anda Siap Diambil');
            });
        }

        return redirect('/logistics/pickup')->with('success', 'Berhasil memperbarui status pesanan siap diambil customer dan dokumen logistik telah digenerate.');
    }

    public function confirmPickup(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'receiver_name' => 'required',
        ]);

        Order::confirmPickup($request->order_id, $request->receiver_name);

        return back()->with('success', 'Pesanan berhasil dikonfirmasi sebagai telah diterima.');
    }
}
