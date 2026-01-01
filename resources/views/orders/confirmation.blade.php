@extends('layouts.app')

@section('title', 'Admin VSATLink | Order Confirmation')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="card">
            <h5 class="card-header">Order Management</h5>

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
                            <th>Tanggal Pesanan</th>
                            <th>Detail Pesanan</th>
                            <th>Detail Customer</th>
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
                                <td><button type="button" class="btn btn-primary btn-detail" data-toggle="modal"
                                        data-target="#orderModal" data-order-id="{{ $order->unique_order }}">
                                        <i class="bx bx-receipt me-2"></i> Lihat
                                    </button></td>
                                <td><button type="button" class="btn btn-primary btn-customer" data-toggle="modal"
                                        data-target="#customerModal" data-order-id="{{ $order->unique_order }}">
                                        <i class="bx bx-user me-2"></i> Lihat
                                    </button></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-confirm" data-toggle="modal"
                                        data-target="#confirmOrderModal"
                                        data-order-id="{{ $order->id }}">Konfirmasi</button>
                                    <button type="button" class="btn btn-danger btn-cancel" data-toggle="modal"
                                        data-target="#cancelOrderModal"
                                        data-order-id="{{ $order->id }}">Batalkan</button>
                                </td>
                            </tr>
                        @endforeach
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

@push('scripts')
    <script>
        let mapInstance;

        $(document).on('click', '.btn-detail', function() {
            let orderId = $(this).data('order-id');

            $.ajax({
                url: '/orders/' + orderId + '/data',
                type: 'GET',
                success: function(res) {
                    let o = res.order;
                    let a = res.address;

                    $('#product_image').attr('src', '/storage/' + o.product_image);
                    $('#product_image').attr('alt', o.product_name);
                    $('#unique_order').text('Order ID: ' + o.unique_order);
                    $('#product_name').text(o.product_name);
                    $('#product_cost').text('Biaya: ' + o.product_cost);
                    $('#created_at').text('Pesanan dibuat pada ' + o.created_at);

                    $('#google_maps_url').attr('href', a.google_maps_url ?? '#');
                    $('#google_maps_url').text(a.google_maps_url ?? '-');

                    let lat = a.latitude ?? -6.602234321160505;
                    let lng = a.longitude ?? 106.80913996183654;

                    if (mapInstance) {
                        mapInstance.remove();
                    }
                    mapInstance = L.map('map').setView([lat, lng], 15);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(mapInstance);

                    L.marker([lat, lng]).addTo(mapInstance)
                        .openPopup();
                },
                error: function() {
                    alert('Gagal mengambil data order');
                }
            });
        });

        $(document).on('click', '.btn-customer', function() {
            let orderId = $(this).data('order-id');

            $.ajax({
                url: '/orders/' + orderId + '/customer/data',
                type: 'GET',
                success: function(res) {
                    let cs = res.customer;
                    let ad = res.address;
                    let ct = res.contact;

                    if (cs.customer_type != 'Perorangan') {
                        $('#label-info').text('Informasi Perusahaan');
                        $('#label-name').text('Nama Perusahaan');
                        $('.company-fields').show();
                        $('#label-npwp').text('Nomor NPWP Perusahaan');
                        $('#label-email').text('Email Perusahaan');
                        $('#label-phone').text('Nomor Telepon Perusahaan');

                        $('#label-address').text('Alamat Perusahaan');
                        $('.contact-fields').show();
                    } else {
                        $('#label-info').text('Informasi Saya');
                        $('#label-name').text('Nama Lengkap');
                        $('.company-fields').hide();
                        $('#label-npwp').text('Nomor NPWP');
                        $('#label-email').text('Email');
                        $('#label-phone').text('Nomor Telepon');

                        $('#label-address').text('Alamat Saya');
                        $('.contact-fields').hide();
                    }

                    $('#customer_type').val(cs.customer_type);
                    $('#username').val(cs.username);
                    $('#name').val(cs.name);
                    $('#company_representative_name').val(cs.company_representative_name);
                    $('#npwp').val(cs.npwp);
                    $('#email').val(cs.email);
                    $('#phone').val(cs.phone);
                    $('#sales').val(cs.sales ?? '-');
                    $('#source_information').val(cs.source_information ?? '-');

                    $('#province').val(ad.province ?? '-');
                    $('#city').val(ad.city ?? '-');
                    $('#district').val(ad.district ?? '-');
                    $('#village').val(ad.village ?? '-');
                    $('#rt').val(ad.rt ?? '-');
                    $('#rw').val(ad.rw ?? '-');
                    $('#postal_code').val(ad.postal_code ?? '-');
                    $('#full_address').val(ad.full_address);

                    $('#contact_name').val(ct.contact_name);
                    $('#contact_email').val(ct.contact_email);
                    $('#contact_phone').val(ct.contact_phone);
                    $('#contact_position').val(ct.contact_position);
                },
                error: function() {
                    alert('Gagal mengambil data customer');
                }
            });
        });

        $(document).on('click', '.btn-confirm', function() {
            let orderId = $(this).data('order-id');
            $('#confirmOrderModal').find('#order_id').val(orderId);
        });

        $(document).on('click', '.btn-cancel', function() {
            let orderId = $(this).data('order-id');
            $('#cancelOrderModal').find('#order_id').val(orderId);
        });
    </script>
@endpush
