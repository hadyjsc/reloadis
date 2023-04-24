@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Statistik Produk</h1>
            {{ Breadcrumbs::render('dashboard.product') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Grafik Penjualan Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="section-title mt-0">Periode</div>
                        <form method="GET" class="">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Tahun</label>
                                    <select class="custom-select col-md-12" name="year">
                                        <option value="">Pilih Tahun</option>
                                        <option value="2023" selected>2023</option>
                                    </select>
                                </div>
                                <div class="form-group mx-sm-3 col">
                                    <label>Bulan</label>
                                    <select class="custom-select col-md-12" name="month">
                                        <option value="">Pilih bulan</option>
                                        @php
                                            foreach ($monthArray as $month) {
                                                $dateNum = date('m', strtotime($month));
                                                if ($dateNum == isset($_GET['month'])) {
                                                    echo '<option value="' . $dateNum . '" selected>' . $month . '</option>';
                                                } else {
                                                    echo '<option value="' . $dateNum . '">' . $month . '</option>';
                                                }
                                            }
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info float-right"><i class="fas fa-filter"></i> Terapkan
                                Filter</button>
                        </form>
                        <canvas id="myChart" class="mt-4" height="130"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4>Daftar Product Paling Laku</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-title mb-2">Pulsa</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="">3,282 Terjual</div>
                                                <div class="text-small text-muted">3000 Zia Ponsel | 282 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">2,976 Terjual</div>
                                                <div class="text-small text-muted">2000 Zia Ponsel | 976 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">1,576 Terjual</div>
                                                <div class="text-small text-muted">1000 Zia Ponsel | 576 Deka Ponsel</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-3 mt-sm-0 mt-4">
                                    <div class="text-title mb-2">Voucer Paket Data</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="">3,282 Terjual</div>
                                                <div class="text-small text-muted">3000 Zia Ponsel | 282 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">2,976 Terjual</div>
                                                <div class="text-small text-muted">2000 Zia Ponsel | 976 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">1,576 Terjual</div>
                                                <div class="text-small text-muted">1000 Zia Ponsel | 576 Deka Ponsel</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-3 mt-sm-0 mt-4">
                                    <div class="text-title mb-2">Kartu Perdana</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="">3,282 Terjual</div>
                                                <div class="text-small text-muted">3000 Zia Ponsel | 282 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">2,976 Terjual</div>
                                                <div class="text-small text-muted">2000 Zia Ponsel | 976 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">1,576 Terjual</div>
                                                <div class="text-small text-muted">1000 Zia Ponsel | 576 Deka Ponsel</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-3 mt-sm-0 mt-4">
                                    <div class="text-title mb-2">Voucher Pulsa</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="">3,282 Terjual</div>
                                                <div class="text-small text-muted">3000 Zia Ponsel | 282 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">2,976 Terjual</div>
                                                <div class="text-small text-muted">2000 Zia Ponsel | 976 Deka Ponsel</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">Deskripsi</div>
                                                <div class="text-small text-muted">1,576 Terjual</div>
                                                <div class="text-small text-muted">1000 Zia Ponsel | 576 Deka Ponsel</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- @php
                            echo "<pre>";
                            print_r($data);
                            echo "</pre>";
                        @endphp --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('chart-javascript')
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($daysArray ? $daysArray : $monthArray),
                datasets: [{
                        label: 'Total Terjual',
                        lineTension: 0.3,
                        data: @json(Arr::pluck($data, 'total_price')),
                        borderWidth: 2,
                        backgroundColor: 'rgba(63,82,227,.8)',
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                    },
                    {
                        label: 'Total Modal',
                        lineTension: 0.3,
                        data: @json(Arr::pluck($data, 'total_fund')),
                        borderWidth: 2,
                        backgroundColor: 'rgba(254,86,83,.7)',
                        borderColor: 'transparent',
                        pointBorderWidth: 0,
                        pointRadius: 3.5,
                        pointBackgroundColor: 'transparent',
                        pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Grafik Penjualan Produk'
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return `Rp. ${value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")}`
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            var text = data.datasets[tooltipItems.datasetIndex].label
                            return text +
                                `: Rp. ${tooltipItems.yLabel.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")}`;
                        }
                    }
                }
            }
        });
    </script>
@endsection
