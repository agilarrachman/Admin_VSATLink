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
                                <td>
                                    {{ $activationNota->installation_session && $activationNota->installation_date
                                        ? $activationNota->installation_session . ' | ' . $activationNota->installation_date->translatedFormat('d F Y')
                                        : '-' }}
                                </td>
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
                                                href="/customer/{{ $activationNota->order->unique_order }}"><i
                                                    class="bx bx-user me-1"></i>
                                                Lihat Informasi Customer</a>
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                                @if ($activationNota->current_status_id == 1)
                                                    <button type="button"
                                                        class="dropdown-item btn-input-installation-schedule"
                                                        data-toggle="modal" data-target="#inputInstallationSchedule"
                                                        data-activation-id="{{ $activationNota->id }}">
                                                        <i class="bx bx-calendar-plus me-1"></i>
                                                        Jadwalkan Instalasi
                                                    </button>
                                                @elseif ($activationNota->current_status_id > 1 && $activationNota->current_status_id <= 3)
                                                    <button type="button"
                                                        class="dropdown-item btn-edit-installation-schedule"
                                                        data-bs-toggle="modal" data-bs-target="#editInstallationSchedule"
                                                        data-activation-id="{{ $activationNota->id }}"
                                                        data-installation-date="{{ $activationNota->installation_date->format('Y-m-d') }}"
                                                        data-installation-session="{{ $activationNota->installation_session }}">
                                                        <i class="bx bx-calendar-plus me-1"></i>
                                                        Ubah Jadwal Instalasi
                                                    </button>
                                                @endif
                                            @endif
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' &&
                                                        auth()->user()->position === 'Provisioning Service Activation'))
                                                @if ($activationNota->current_status_id == 4)
                                                    <a class="dropdown-item"
                                                        href="/service-activations/provisioning/{{ $activationNota->id }}">
                                                        <i class="bx bx-cog me-1"></i>
                                                        Input Data Provisioning
                                                    </a>
                                                @elseif ($activationNota->current_status_id >= 5)
                                                    <a class="dropdown-item"
                                                        href="/service-activations/provisioning/{{ $activationNota->id }}/edit">
                                                        <i class="bx bx-cog me-1"></i>
                                                        Edit Data Provisioning
                                                    </a>
                                                @endif
                                            @endif
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' && auth()->user()->position === 'Installation Coordinator'))
                                                @if ($activationNota->current_status_id == 5)
                                                    <form
                                                        action="/service-activations/technician-on-the-way/{{ $activationNota->id }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Teknisi Dalam Perjalanan?')">
                                                            <i class="bx bx-navigation me-1"></i>
                                                            Teknisi Dalam Perjalanan
                                                        </button>
                                                    </form>
                                                @elseif ($activationNota->current_status_id == 6)
                                                    <form
                                                        action="/service-activations/technician-arrived/{{ $activationNota->id }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Apakah Anda yakin ingin mengubah status menjadi Teknisi Tiba Di Lokasi?')">
                                                            <i class="bx bx-navigation me-1"></i>
                                                            Teknisi Tiba Di Lokasi
                                                        </button>
                                                    </form>
                                                @elseif ($activationNota->current_status_id == 7)
                                                    <a class="dropdown-item"
                                                        href="/service-activations/technical-data/{{ $activationNota->id }}">
                                                        <i class="bx bx-wrench me-1"></i>
                                                        Input Data Teknis
                                                    </a>
                                                @elseif ($activationNota->current_status_id >= 8)
                                                    <a class="dropdown-item"
                                                        href="/service-activations/technical-data/{{ $activationNota->id }}/edit">
                                                        <i class="bx bx-wrench me-1"></i>
                                                        Edit Data Teknis
                                                    </a>
                                                @endif
                                            @endif
                                            @if (auth()->user()->role === 'Super Admin' ||
                                                    (auth()->user()->role === 'Service Operation Admin' &&
                                                        auth()->user()->position === 'Provisioning Service Activation'))
                                                @if ($activationNota->current_status_id >= 8)
                                                    @if ($activationNota->sensor_status == null)
                                                        <a class="dropdown-item"
                                                            href="/service-activations/verification/{{ $activationNota->id }}">
                                                            <i class="bx bx-check-shield me-1"></i>
                                                            Verifikasi Layanan Aktif
                                                        </a>
                                                    @else
                                                        <a class="dropdown-item"
                                                            href="/service-activations/verification/{{ $activationNota->id }}/edit">
                                                            <i class="bx bx-check-shield me-1"></i>
                                                            Edit Verifikasi Layanan Aktif
                                                        </a>
                                                    @endif
                                                @endif
                                                @if ($activationNota->activation_document_url != null && $activationNota->current_status_id >= 10)
                                                    <a class="dropdown-item"
                                                        href="/service-activations/download/spa/{{ $activationNota->id }}">
                                                        <i class="bx bx-file me-1"></i>
                                                        Unduh SPA
                                                    </a>
                                                @endif
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('partials.modals.input-installation-schedule')
    @include('partials.modals.edit-installation-schedule')
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.btn-input-installation-schedule', function() {
            let activationNotaId = $(this).data('activation-id');
            $('#inputInstallationSchedule').find('#activation_nota_id').val(activationNotaId);
        });

        $(document).on('click', '.btn-edit-installation-schedule', function() {
            const activationNotaId = $(this).data('activation-id');
            const installationDate = $(this).data('installation-date');
            const installationSession = $(this).data('installation-session');

            const modal = $('#editInstallationSchedule');

            modal.find('#edit_installation_activation_nota_id').val(activationNotaId);
            modal.find('#edit_installation_date').val(installationDate ?? '');

            modal.find('#edit_installation_session_morning')
                .prop('checked', installationSession === 'Pagi');

            modal.find('#edit_installation_session_afternoon')
                .prop('checked', installationSession === 'Siang');

            modal.find('#edit_submit_btn').prop('disabled', !installationDate);
        });
    </script>
@endpush
