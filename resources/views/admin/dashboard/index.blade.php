@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-sm-12">
                                <div
                                    class="statistics-details
                                    align-items-center justify-content-between
                                    d-sm-block d-md-flex">
                                    <!-- Total Sales -->
                                    <div>
                                        <p class="statistics-title">Total Pendapatan</p>
                                        <h3 class="rate-percentage">{{ $totalSales ?? '-' }}</h3>
                                        @if ($totalSalesDifference['is_up'] == true)
                                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>
                                                    {{ $totalSalesDifference['percentage'] }}%
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>
                                                    {{ $totalSalesDifference['percentage'] }}%
                                                </span>
                                            </p>
                                        @endif
                                    </div>
                                    <!-- Total Sales Daily -->
                                    <div>
                                        <p class="statistics-title">Total Pendapatan Harian</p>
                                        <h3 class="rate-percentage">{{ $totalSalesDaily ?? '-' }}</h3>
                                        @if ($totalSalesDifference['is_up'] == true)
                                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>
                                                    {{ $totalSalesDifference['percentage'] }}%
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>
                                                    {{ $totalSalesDifference['percentage'] }}%
                                                </span>
                                            </p>
                                        @endif
                                    </div>
                                    <!-- Total Customer -->
                                    <div>
                                        <p class="statistics-title">Total Pelanggan</p>
                                        <h3 class="rate-percentage">{{ $totalCustomer ?? '-' }}</h3>
                                        @if ($totalCustomerDifference['is_up'] == true)
                                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>
                                                    {{ $totalCustomerDifference['difference'] }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>
                                                    {{ $totalCustomerDifference['difference'] }}
                                                </span>
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Total Customer Daily -->
                                    <div>
                                        <p class="statistics-title">Total Pelanggan Harian</p>
                                        <h3 class="rate-percentage">{{ $totalCustomerDaily ?? '-' }}</h3>
                                        @if ($totalCustomerDifference['is_up'] == true)
                                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>
                                                    {{ $totalCustomerDifference['difference'] }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>
                                                    {{ $totalCustomerDifference['difference'] }}
                                                </span>
                                            </p>
                                        @endif
                                    </div>
                                    <!-- Total Produk Terjual -->
                                    <div>
                                        <p class="statistics-title">Total Produk Terjual</p>
                                        <h3 class="rate-percentage">{{ $totalProductSales ?? '-' }}</h3>
                                        @if ($totalProductSalesDifference['is_up'] == true)
                                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>
                                                    {{ $totalProductSalesDifference['difference'] }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>
                                                    {{ $totalProductSalesDifference['difference'] }}
                                                </span>
                                            </p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 d-flex flex-column">
                                {{-- <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Market
                                                            Overview</h4>
                                                        <p class="card-subtitle card-subtitle-dash">
                                                            Lorem ipsum dolor sit amet consectetur
                                                            adipisicing elit</p>
                                                    </div>
                                                    <div>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                                type="button" id="dropdownMenuButton2"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"> This month
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton2">
                                                                <h6 class="dropdown-header">Settings
                                                                </h6>
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated link</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                    <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                        <h2 class="me-2 fw-bold">$36,2531.00</h2>
                                                        <h4 class="me-2">USD</h4>
                                                        <h4 class="text-success">(+1.37%)</h4>
                                                    </div>
                                                    <div class="me-3">
                                                        <div id="marketing-overview-legend"></div>
                                                    </div>
                                                </div>
                                                <div class="chartjs-bar-wrapper mt-3">
                                                    <canvas id="marketingOverview"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">
                                                            Pemesanan Terbaru</h4>
                                                        <p class="card-subtitle card-subtitle-dash">
                                                            Data pemesanan terbaru</p>
                                                    </div>
                                                    <div>
                                                        <a class="btn btn-primary btn-lg text-white mb-0 me-0"
                                                            href="{{ route('admin.order.index') }}">
                                                            Lihat Semua
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mt-1">
                                                    <table class="table table-small" id="orderTable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                {{-- <th>Pelanggan</th> --}}
                                                                <th>No. Invoice</th>
                                                                <th>Total Pemesanan</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="card-title card-title-dash">
                                                                Total Pemesanan</h4>
                                                        </div>
                                                        <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                                        <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>

            let totalSalesProductCategory = @json($totalSalesProductCategory);
            let totalSalesProductCategoryLabel = [];
            let totalSalesProductCategoryData = [];
            let totalSalesProductCategoryColor = [];

            Object.keys(totalSalesProductCategory).forEach(function (key) {
                totalSalesProductCategoryLabel.push(key);
                totalSalesProductCategoryData.push(totalSalesProductCategory[key]);
                totalSalesProductCategoryColor.push('#' + Math.floor(Math.random() * 16777215).toString(16));
            });

            let totalSalesProductCategoryChart = document.getElementById('doughnutChart').getContext('2d');
            let doughnutChart = new Chart(totalSalesProductCategoryChart, {
                type: 'doughnut',
                data: {
                    labels: totalSalesProductCategoryLabel.map(function (label) {
                        return label.charAt(0).toUpperCase() + label.slice(1);
                    }),
                    datasets: [{
                        data: totalSalesProductCategoryData,
                        backgroundColor: totalSalesProductCategoryColor,
                        borderWidth: 0
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    legend: {
                        display: false,
                        position: 'bottom',
                        labels: {
                            fontColor: '#333',
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltips: {
                        enabled: true,
                        mode: 'single',
                        callbacks: {
                            label: function(tooltipItems, data) {
                                return data.labels[tooltipItems.index] + ': ' + data.datasets[0].data[tooltipItems.index].toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            display: false,
                            color: 'white'
                        }
                    }
                }
            });

            let totalSalesProductCategoryLegend = doughnutChart.generateLegend();
            $('#doughnut-chart-legend').html(totalSalesProductCategoryLegend);


            $(function() {
                $('#orderTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.order.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        // {
                        //     data: 'customer',
                        //     name: 'customer'
                        // },
                        {
                            data: 'transaction_code',
                            name: 'transaction_code'
                        },
                        {
                            data: 'total_payment',
                            name: 'total_payment'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
