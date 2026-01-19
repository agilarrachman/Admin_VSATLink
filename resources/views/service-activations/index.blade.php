@extends('layouts.app')

@section('title', 'Admin VSATLink | Service Activations')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="card">
            <h5 class="card-header">Service Activations Management</h5>

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
                            <th>Customer</th>
                            <th>Produk Layanan</th>
                            <th>Jadwal Instalasi</th>
                            <th>Tanggal Aktivasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($activationNotas as $activationNota)
                            <tr>
                                <td>{{ $activationNota->order->unique_order }}</td>
                                <td>{{ $activationNota->order->customer->name }}</td>
                                <td>{{ $activationNota->order->product->name }}</td>
                                <td>{{ $activationNota->installation_date?->translatedFormat('d M Y, H:i') ?? '-' }}</td>
                                <td>{{ $activationNota->online_date?->translatedFormat('d M Y, H:i') ?? '-' }}</td>
                                </td>
                                @php($badge = $activationNota->statusBadge())
                                <td><span class="badge me-1 {{ $badge['class'] }}">{{ $badge['label'] }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="/service-activations/detail/{{ $activationNota->id }}"><i
                                                    class="bx bx-show me-1"></i>
                                                Lihat Detail Aktivasi</a>
                                            <a class="dropdown-item"
                                                href="/service-activations/{{ $activationNota->id }}/customer"><i
                                                    class="bx bx-user me-1"></i>
                                                Lihat Informasi Customer</a>
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                                <button type="button" class="dropdown-item btn-input-installation-schedule"
                                                    data-toggle="modal" data-target="#inputInstallationSchedule"
                                                    data-activation-id="{{ $nota->id }}">
                                                    <i class="bx bx-calendar-plus me-1"></i>
                                                    Jadwalkan Instalasi
                                                </button>
                                            @endif
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' &&
                                                        auth()->user()->position === 'Provisioning Service Activation'))
                                                <a class="dropdown-item" href="/service-activations/provisioning">
                                                    <i class="bx bx-cog me-1"></i>
                                                    Input Data Provisioning
                                                </a>
                                            @endif
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                                <a class="dropdown-item" href="/service-activations/technical-data">
                                                    <i class="bx bx-wrench me-1"></i>
                                                    Input Data Teknis
                                                </a>
                                            @endif
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' &&
                                                        auth()->user()->position === 'Provisioning Service Activation'))
                                                <a class="dropdown-item" href="/service-activations/verification">
                                                    <i class="bx bx-check-shield me-1"></i>
                                                    Verifikasi Layanan Aktif
                                                </a>
                                            @endif
                                            @if ($activationNota->activation_document_url != null)
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i class="bx bx-file me-1"></i>
                                                    Unduh SPA
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="menu-icon tf-icons bx bx-broadcast"></i>
                                    Belum ada data nota aktivasi
                                </td>
                            </tr>
                        @endforelse
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
                                        <a class="dropdown-item" href="/service-activations/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/service-activations/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <button type="button" class="dropdown-item btn-input-installation-schedule"
                                                data-toggle="modal" data-target="#inputInstallationSchedule"
                                                data-activation-id="1">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </button>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Input Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/technical-data">
                                                <i class="bx bx-wrench me-1"></i>
                                                Input Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/verification">
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
                                        <a class="dropdown-item" href="/service-activations/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/service-activations/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Input Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/technical-data">
                                                <i class="bx bx-wrench me-1"></i>
                                                Input Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/verification">
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
                                        <a class="dropdown-item" href="/service-activations/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/service-activations/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Input Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/technical-data">
                                                <i class="bx bx-wrench me-1"></i>
                                                Input Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/verification">
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
                                        <a class="dropdown-item" href="/service-activations/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/service-activations/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Input Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/technical-data">
                                                <i class="bx bx-wrench me-1"></i>
                                                Input Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/verification">
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
                                        <a class="dropdown-item" href="/service-activations/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/service-activations/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Input Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/technical-data">
                                                <i class="bx bx-wrench me-1"></i>
                                                Input Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/verification">
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
                                        <a class="dropdown-item" href="/service-activations/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/service-activations/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Input Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/technical-data">
                                                <i class="bx bx-wrench me-1"></i>
                                                Input Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/verification">
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
                                        <a class="dropdown-item" href="/service-activations/show">
                                            <i class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi
                                        </a>

                                        <a class="dropdown-item" href="/service-activations/customer">
                                            <i class="bx bx-user me-1"></i>
                                            Lihat Informasi Customer
                                        </a>

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/schedule">
                                                <i class="bx bx-calendar-plus me-1"></i>
                                                Jadwalkan Instalasi
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/provisioning">
                                                <i class="bx bx-cog me-1"></i>
                                                Input Data Provisioning
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                            <a class="dropdown-item" href="/service-activations/technical-data">
                                                <i class="bx bx-wrench me-1"></i>
                                                Input Data Teknis
                                            </a>
                                        @endif

                                        @if (auth()->user()->role === 'Super Admin' ||
                                                (auth()->user()->role === 'Service Operation Admin' &&
                                                    auth()->user()->position === 'Provisioning Service Activation'))
                                            <a class="dropdown-item" href="/service-activations/verification">
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
                                        <a class="dropdown-item" href="/service-activations/show"><i
                                                class="bx bx-show me-1"></i>
                                            Lihat Detail Aktivasi</a>
                                        <a class="dropdown-item" href="/service-activations/customer"><i
                                                class="bx bx-user me-1"></i>
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
    @include('partials.modals.input-installation-schedule')
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.btn-input-installation-schedule', function() {
            let activationNotaId = $(this).data('activation-id');
            $('#inputInstallationSchedule').find('#activationNota_id').val(activationNotaId);
        });
    </script>
@endpush
