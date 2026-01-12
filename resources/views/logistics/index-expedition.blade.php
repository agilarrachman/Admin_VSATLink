@extends('layouts.app')

@section('title', 'Admin VSATLink | Logistic Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="card">
            <h5 class="card-header">Logistic Management</h5>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Nomor Resi</th>
                            <th>Customer</th>
                            <th>Produk Layanan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($orders as $order)
                            @php
                                $snFilled =
                                    $order->modem_sn &&
                                    $order->adaptor_sn &&
                                    $order->buc_sn &&
                                    $order->lnb_sn &&
                                    $order->antena_sn;

                                if (!is_null($order->product->access_point)) {
                                    $snFilled = $snFilled && $order->router_sn;
                                }
                            @endphp

                            <tr>
                                <td>{{ $order->unique_order }}</td>
                                <td>{{ $order->jne_tracking_number ?? '-' }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->created_at->translatedFormat('d M Y, H:i') }}</td>
                                </td>
                                @php($badge = $order->statusBadge())
                                <td><span class="badge me-1 {{ $badge['class'] }}">{{ $badge['label'] }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/orders/{{ $order->unique_order }}">
                                                <i class="bx bx-show me-1"></i>
                                                Lihat Detail Pesanan
                                            </a>

                                            <a class="dropdown-item" href="/orders/{{ $order->unique_order }}/customer">
                                                <i class="bx bx-user me-1"></i>
                                                Lihat Informasi Customer
                                            </a>

                                            @if ($order->current_status_id <= 4)
                                                @if ($snFilled)
                                                    <a class="dropdown-item"
                                                        href="/logistics/edit-sn/{{ $order->unique_order }}">
                                                        <i class="bx bx-barcode me-1"></i>
                                                        Edit Serial Number
                                                    </a>

                                                    <form action="/logistics/request-pickup/{{ $order->unique_order }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bxs-truck me-1"></i>
                                                            Request Pickup
                                                        </button>
                                                    </form>
                                                @else
                                                    <a class="dropdown-item"
                                                        href="/logistics/input-sn/{{ $order->unique_order }}">
                                                        <i class="bx bx-barcode me-1"></i>
                                                        Input Serial Number
                                                    </a>
                                                @endif
                                            @endif

                                            @if ($order->current_status_id >= 5 && $order->current_status_id < 8)
                                                <a class="dropdown-item"
                                                    href="{{ asset('storage/' . $order->packing_list_document_url) }}"
                                                    download="{{ 'PACKING LIST-' . $order->unique_order . '.pdf' }}">
                                                    <i class="bx bx-package me-1"></i>
                                                    Unduh Dokumen Packing List
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ asset('storage/' . $order->delivery_note_document_url) }}"
                                                    download="{{ 'SURAT JALAN-' . $order->unique_order . '.pdf' }}">
                                                    <i class="bx bx-receipt me-1"></i>
                                                    Unduh Dokumen Surat Jalan
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="menu-icon tf-icons bx bx-package"></i>
                                    Belum ada data pesanan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
