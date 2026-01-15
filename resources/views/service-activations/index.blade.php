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
                            <th>Jadwal Instalasi</th>
                            <th>Tanggal Aktivasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-danger me-1">Belum Dijadwalkan</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/orders/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Lengkapi Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/technical">
                                                <i class="bx bx-wrench me-1"></i>
                                                Lengkapi Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/verify">
                                                <i class="bx bx-check-shield me-1"></i>
                                                Verifikasi Layanan Aktif
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-file me-1"></i>
                                            Unduh SPA
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-warning me-1">Sudah Dijadwalkan</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/orders/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Lengkapi Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/technical">
                                                <i class="bx bx-wrench me-1"></i>
                                                Lengkapi Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/verify">
                                                <i class="bx bx-check-shield me-1"></i>
                                                Verifikasi Layanan Aktif
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-file me-1"></i>
                                            Unduh SPA
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-info me-1">Siap Instalasi</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/orders/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Lengkapi Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/technical">
                                                <i class="bx bx-wrench me-1"></i>
                                                Lengkapi Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/verify">
                                                <i class="bx bx-check-shield me-1"></i>
                                                Verifikasi Layanan Aktif
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-file me-1"></i>
                                            Unduh SPA
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-info me-1">Teknisi Dalam Perjalanan</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/orders/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Lengkapi Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/technical">
                                                <i class="bx bx-wrench me-1"></i>
                                                Lengkapi Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/verify">
                                                <i class="bx bx-check-shield me-1"></i>
                                                Verifikasi Layanan Aktif
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-file me-1"></i>
                                            Unduh SPA
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-info me-1">Teknisi Tiba Di Lokasi</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/orders/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Lengkapi Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/technical">
                                                <i class="bx bx-wrench me-1"></i>
                                                Lengkapi Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/verify">
                                                <i class="bx bx-check-shield me-1"></i>
                                                Verifikasi Layanan Aktif
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-file me-1"></i>
                                            Unduh SPA
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-secondary me-1">Request Aktivasi</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/orders/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Lengkapi Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/technical">
                                                <i class="bx bx-wrench me-1"></i>
                                                Lengkapi Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/verify">
                                                <i class="bx bx-check-shield me-1"></i>
                                                Verifikasi Layanan Aktif
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-file me-1"></i>
                                            Unduh SPA
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-success me-1">Aktivasi Terverifikasi</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/orders/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Lengkapi Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/orders/technical">
                                                <i class="bx bx-wrench me-1"></i>
                                                Lengkapi Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/orders/verify">
                                                <i class="bx bx-check-shield me-1"></i>
                                                Verifikasi Layanan Aktif
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="bx bx-file me-1"></i>
                                            Unduh SPA
                                        </a>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VSL6637373</td>
                            <td>Albert Cook</td>
                            <td>VSATLink Aurora</td>
                            <td>11 November 2025</td>
                            <td>11 November 2025</td>
                            <td><span class="badge bg-label-success me-1">SPA Ditandatangani</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/orders/show"><i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi</a>
                                        <a class="dropdown-item" href="/orders/customer"><i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-receipt me-1"></i> Unduh SPA</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
