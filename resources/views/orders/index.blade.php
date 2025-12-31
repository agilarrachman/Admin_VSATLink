@extends('layouts.app')

@section('title', 'Admin VSATLink | Order Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="card">
            <h5 class="card-header">Order Management</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Produk Layanan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->unique_order }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->created_at->translatedFormat('d M Y, H:i') }}</td>
                                <td>{{ $order->total_cost ? 'Rp' . number_format($order->total_cost, 0, ',', '.') : '-' }}</td>
                                @php($badge = $order->statusBadge())
                                <td><span class="badge me-1 {{ $badge['class'] }}">{{ $badge['label'] }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i>
                                                Lihat Detail Pesanan</a>
                                            <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                                Lihat Informasi Customer</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-receipt me-1"></i> Unduh Invoice</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        {{-- Dummy Data Start --}}
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>Rp19.400.000</td>
                            <td><span class="badge bg-label-secondary me-1">Menunggu Konfirmasi</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i>
                                            Lihat Detail Pesanan</a>
                                        <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-receipt me-1"></i> Unduh Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>Rp19.400.000</td>
                            <td><span class="badge bg-label-secondary me-1">Pesanan Dikonfirmasi</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i> Lihat
                                            Detail Pesanan</a>
                                        <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-receipt me-1"></i> Unduh Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>Rp19.400.000</td>
                            <td><span class="badge bg-label-warning me-1">Belum Dibayar</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i> Lihat
                                            Detail Pesanan</a>
                                        <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-receipt me-1"></i> Unduh Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>Rp19.400.000</td>
                            <td><span class="badge bg-label-info me-1">Sedang Diproses</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i> Lihat
                                            Detail Pesanan</a>
                                        <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-receipt me-1"></i> Unduh Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>Rp19.400.000</td>
                            <td><span class="badge bg-label-danger me-1">Dibatalkan</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i> Lihat
                                            Detail Pesanan</a>
                                        <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-receipt me-1"></i> Unduh Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>Rp19.400.000</td>
                            <td><span class="badge bg-label-success me-1">Selesai</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i>
                                            Lihat
                                            Detail Pesanan</a>
                                        <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-receipt me-1"></i> Unduh Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{-- Dummy Data End --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
