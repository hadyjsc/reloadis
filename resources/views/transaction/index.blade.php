@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Rekap Transaksi</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Transaksi</label>
                                    <input class="form-control datepicker" name="transaction-date" type="text" value="{{ $soldAt }}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <select class="form-control" name="type-id">
                                        <option value="">Pilih tipe transaksi</option>
                                        @foreach ($types as $item)
                                        @if ($typeID == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="category-id">
                                        <option value="">Pilih kategori transaksi</option>
                                        @foreach ($categories as $item)
                                        @if ($categoryID == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                    <button class="btn btn-info float-right"><i class="fa fa-filter"></i> Terapkan Filter</button>
                                    <a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i> Cetak laporan ke Excel</a>
                                    <a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-pdf"></i> Cetak laporan ke PDF</a>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-3">
                                @if (count($data) > 0)
                                @php
                                    $totalSold = 0;
                                    $totalFund = 0;
                                    $totalProfit = 0;
                                @endphp
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Provider</th>
                                            <th>Stock</th>
                                            <th>Sisa Stock</th>
                                            <th>Terjual</th>
                                            <th>Harga</th>
                                            <th>Modal</th>
                                            <th>Total Modal <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Dengan ketentuan: Modal x Terjual"></i></th>
                                            <th>Keuntungan <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Dengan ketentuan: (Harga - Modal) x Terjual"></i></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->name ? $item->name : '-' }}</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>{{ $item->last_stock }}</td>
                                                <td>{{ $item->sold }}</td>
                                                <td>{{ $item->price ? 'Rp. '.number_format($item->price, 0, ',', '.') : 0 }}</td>
                                                <td>{{ $item->fund ? 'Rp. '.number_format($item->fund, 0, ',', '.') : 0 }}</td>
                                                <td>{{ $item->total_fund ? 'Rp. '.number_format($item->total_fund, 0, ',', '.') : 0 }}</td>
                                                <td>{{ $item->profit ? 'Rp. '.number_format($item->profit, 0, ',', '.') : 0 }}</td>
                                            </tr>
                                            @php
                                                $totalSold += $item->price * $item->sold;
                                                $totalFund += $item->total_fund;
                                                $totalProfit += $item->profit;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">Total Terjual</td>
                                                <td>{{ 'Rp. '.number_format($totalSold, 0, ',', '.')  }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">Total Modal</td>
                                                <td>{{ 'Rp. '.number_format($totalFund , 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">Total profit yang diperoleh</td>
                                                <td>{{ 'Rp. '.number_format( $totalProfit , 0, ',', '.')}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <div class="alert alert-light text-center mt-3">Data transaksi tidak ditemukan</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
