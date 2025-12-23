@extends('layouts.app')

@section('title', 'Admin VSATLink | Order Confirmation')

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
                            <th>Detail Pesanan</th>
                            <th>Detail Customer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#orderModal">
                                    <i class="bx bx-receipt me-2"></i> Lihat
                                </button></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#customerModal">
                                    <i class="bx bx-user me-2"></i> Lihat
                                </button></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#confirmOrderModal">Konfirmasi</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancelOrderModal">Batalkan</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials.modals.customer-detail')
    @include('partials.modals.order-detail')
    @include('partials.modals.confirm-order')
    @include('partials.modals.cancel-order')
@endsection
