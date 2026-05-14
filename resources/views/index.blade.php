@extends('layouts.app')

@section('title', 'Admin VSATLink | Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0 d-flex px-0">
                <div class="col-lg-3 col-md-12 col-6">
                    <div class="card" style="height: 160px">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/total revenue.png" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-medium d-block mb-1">Total Revenue</span>
                            <h3 class="card-title mb-2">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6">
                    <div class="card" style="height: 160px">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/total active orders.png" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span>Total Active Orders</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $totalActiveOrders }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6">
                    <div class="card" style="height: 160px">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/total on progress activation.png" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span>Total On-Progress Activations</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $totalOnProgressActivation }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6">
                    <div class="card" style="height: 160px">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/total activate vsat.png" alt="Credit Card"
                                        class="rounded" />
                                </div>
                            </div>
                            <span>Total Active VSAT</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $activeVSAT }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Product Statistics -->
            <div class="col-lg-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-2">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Product Overview</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="productDonutChart" class="pb-4"></div>
                        <ul class="p-0 m-0">
                            @foreach ($productStats as $item)
                                <li class="d-flex mb-4 pb-3" style="border-bottom: 0.8px solid #D9DEE3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="/storage/{{ $item->image_url }}" class="rounded"
                                            alt="{{ $item->name }}">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $item->name }}</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-medium">{{ $item->total }} Orders</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Product Statistics -->

            <!-- Revenue Growth -->
            <div class="col-lg-8 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="card-title mb-3">
                            <h5 class="m-0 me-2">VSAT Revenue Growth</h5>
                        </div>
                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active revenue-filter" data-type="monthly">
                                    Monthly
                                </button>
                            </li>

                            <li class="nav-item">
                                <button type="button" class="nav-link revenue-filter" data-type="weekly">
                                    Weekly
                                </button>
                            </li>

                            <li class="nav-item">
                                <button type="button" class="nav-link revenue-filter" data-type="daily">
                                    Daily
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body px-0">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                <div id="incomeChart"></div>
                                <div class="d-flex justify-content-center pt-4 gap-2">
                                    <div>
                                        <p class="mb-n1 mt-1 text-center" id="revenueTitle">
                                            Revenue This Month
                                        </p>

                                        <small id="revenueComparison"
                                            class="{{ $monthlyDifference >= 0 ? 'text-success' : 'text-danger' }}">

                                            @if ($monthlyDifference >= 0)
                                                +{{ $monthlyPercentage }}%
                                                (Rp{{ number_format($monthlyDifference, 0, ',', '.') }})
                                                compared to last month
                                            @else
                                                {{ $monthlyPercentage }}%
                                                (Rp{{ number_format(abs($monthlyDifference), 0, ',', '.') }})
                                                lower than last month
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Revenue Growth -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Distribution Overview -->
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-2">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">VSAT Distribution Overview</h5>
                            <small class="text-muted">Overview of VSAT installation locations across regions</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="map" class="w-full mt-3" style="height: 400px; border-radius: 0.5rem;"></div>
                    </div>
                </div>
                <!--/ Distribution Overview -->
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // === Script Product Overview Start ===
        const productLabels = @json($productStats->pluck('name'));
        const productSeries = @json($productStats->pluck('total'));
        // console.log(productSeries);
        // console.log(productLabels);

        const chartEl = document.querySelector("#productDonutChart");

        const totalOrders = productSeries.reduce((a, b) => a + b, 0);

        const options = {
            chart: {
                type: 'donut',
                height: 200
            },
            series: productSeries,
            labels: productLabels,
            colors: ['#696cff', '#03c3ec', '#71dd37', '#ffab00', '#ff3e1d'],
            legend: {
                position: 'right',
                fontSize: '13px'
            },
            dataLabels: {
                enabled: false
            },
            tooltip: {
                y: {
                    formatter: (val) => `${val} Orders`
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                offsetY: -5
                            },
                            value: {
                                show: true,
                                offsetY: 5,
                                formatter: (val) => val
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: () => totalOrders
                            }
                        }
                    }
                }
            }
        };

        const chart = new ApexCharts(chartEl, options);
        chart.render();
        // === Script Product Overview End ===

        // === Script Revenue Growth Start ===
        const monthlyRevenue = @json($monthlyRevenue);
        const weeklyRevenue = @json($weeklyRevenue);
        const weeklyCategories = @json($weeklyCategories);
        const dailyRevenue = @json($dailyRevenue);
        const dailyCategories = @json($dailyCategories);

        let revenueChart;

        const comparisonData = {
            monthly: {
                title: 'Revenue This Month',
                percentage: @json($monthlyPercentage),
                difference: @json($monthlyDifference),
                compareText: 'compared to last month'
            },

            weekly: {
                title: 'Revenue This Week',
                percentage: @json($weeklyPercentage),
                difference: @json($weeklyDifference),
                compareText: 'compared to last week'
            },

            daily: {
                title: 'Revenue Today',
                percentage: @json($dailyPercentage),
                difference: @json($dailyDifference),
                compareText: 'compared to yesterday'
            }
        };

        const chartOptions = {
            series: [{
                name: 'Revenue',
                data: monthlyRevenue
            }],

            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false
                },
                parentHeightOffset: 0
            },

            dataLabels: {
                enabled: false
            },

            stroke: {
                curve: 'smooth',
                width: 3
            },

            colors: ['#696cff'],

            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    shadeIntensity: 0.5,
                    opacityFrom: 0.5,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },

            markers: {
                size: 5,
                hover: {
                    size: 7
                }
            },

            grid: {
                borderColor: '#e7e7e7',
                strokeDashArray: 4,
                padding: {
                    top: -10,
                    right: 10,
                    bottom: -10,
                    left: 10
                }
            },

            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },

            yaxis: {
                labels: {
                    formatter: function(val) {
                        return 'Rp ' + val.toLocaleString('id-ID');
                    }
                }
            },

            tooltip: {
                y: {
                    formatter: function(val) {
                        return 'Rp ' + val.toLocaleString('id-ID');
                    }
                }
            },

            legend: {
                show: false
            }
        };

        revenueChart = new ApexCharts(
            document.querySelector("#incomeChart"),
            chartOptions
        );

        revenueChart.render();

        document.querySelectorAll('.revenue-filter').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.revenue-filter')
                    .forEach(btn => btn.classList.remove('active'));

                this.classList.add('active');

                const type = this.dataset.type;

                let data = [];
                let categories = [];

                if (type === 'monthly') {
                    data = monthlyRevenue;
                    categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ];
                }

                if (type === 'weekly') {
                    data = weeklyRevenue;
                    categories = weeklyCategories;
                }

                if (type === 'daily') {
                    data = dailyRevenue;
                    categories = dailyCategories;
                }

                revenueChart.updateOptions({
                    xaxis: {
                        categories: categories
                    }
                });

                revenueChart.updateSeries([{
                    name: 'Revenue',
                    data: data
                }]);

                const comparison = comparisonData[type];

                document.getElementById('revenueTitle').innerText =
                    comparison.title;

                const comparisonEl = document.getElementById('revenueComparison');

                const isPositive = comparison.difference >= 0;

                comparisonEl.className =
                    isPositive ? 'text-success' : 'text-danger';

                comparisonEl.innerHTML = `
                    ${isPositive ? '+' : ''}
                    ${comparison.percentage}%
                    (Rp${Math.abs(comparison.difference).toLocaleString('id-ID')})
                    ${isPositive ? comparison.compareText : 'lower than ' + comparison.compareText.replace('compared to ', '')}
                `;
            });
        });
        // === Script Revenue Growth End ===

        // === Script Preview Map Start ===
        const defaultLat = -2.5;
        const defaultLng = 118.0;

        const map = L.map('map').setView([defaultLat, defaultLng], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const activationLocations = @json($activationLocations);

        const bounds = [];

        activationLocations.forEach(location => {

            const lat = parseFloat(location.latitude);
            const lng = parseFloat(location.longitude);

            const popupContent = `
                <div style="width:270px">
                    <h6>Total Orders: ${location.total_orders}</h6>

                    <strong>Total Revenue:</strong><br>
                    Rp${Number(location.total_revenue).toLocaleString('id-ID')}

                    <hr>

                    <strong>Unique Order:</strong><br>
                    ${location.unique_orders}

                    <hr>

                    <a href="${location.google_maps_url}"
                        target="_blank"
                        class="btn btn-sm btn-primary text-white">
                        Open Maps
                    </a>
                </div>
            `;

            L.marker([lat, lng])
                .addTo(map)
                .bindPopup(popupContent);

            bounds.push([lat, lng]);
        });

        if (bounds.length > 0) {
            map.fitBounds(bounds);
        }
        // === Script Preview Map End ===
    </script>
@endpush
