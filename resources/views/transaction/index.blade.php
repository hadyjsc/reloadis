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
                                    @php
                                        $request = '?'.http_build_query(array_merge(request()->all()));
                                    @endphp
                                    <a href="{{ route('transactions.export', 'xlsx').$request  }}" target="_blank" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i> Cetak laporan ke Excel</a>
                                    <a href="{{ route('transactions.export', 'pdf').$request }}" target="_blank" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-pdf"></i> Cetak laporan ke PDF</a>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-3">
                                @if (count($data) > 0)
                                @php
                                    $totalStock = 0;
                                    $totalLastStock = 0;
                                    $totalItem = 0;
                                    $totalSold = 0;
                                    $totalPrice = 0;
                                    $totalFundingPrice = 0;
                                    $totalFund = 0;
                                    $totalProfit = 0;
                                    $i = 1;
                                @endphp
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Provider</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Sisa Stock</th>
                                            <th class="text-center">Terjual</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Modal</th>
                                            <th class="text-center">Total Modal <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Dengan ketentuan: Modal x Terjual"></i></th>
                                            <th class="text-center">Keuntungan <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Dengan ketentuan: (Harga - Modal) x Terjual"></i></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item->name ? $item->name : '-' }}</td>
                                                <td class="text-center">{{ $item->stock }}</td>
                                                <td  class="text-center">{{ $item->last_stock }}</td>
                                                <td class="text-center">{{ $item->sold }}</td>
                                                <td class="text-right">{{ $item->price ? 'Rp. '.number_format($item->price, 0, ',', '.') : 0 }}</td>
                                                <td class="text-right">{{ $item->fund ? 'Rp. '.number_format($item->fund, 0, ',', '.') : 0 }}</td>
                                                <td class="text-right">{{ $item->total_fund ? 'Rp. '.number_format($item->total_fund, 0, ',', '.') : 0 }}</td>
                                                <td class="text-right">{{ $item->profit ? 'Rp. '.number_format($item->profit, 0, ',', '.') : 0 }}</td>
                                            </tr>
                                            @php
                                                $totalStock += $item->stock;
                                                $totalLastStock += $item->last_stock;
                                                $totalItem += $item->sold;
                                                $totalSold += $item->price * $item->sold;
                                                $totalPrice += $item->price;
                                                $totalFundingPrice += $item->fund;
                                                $totalFund += $item->total_fund;
                                                $totalProfit += $item->profit;
                                                $i++;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-info text-white">
                                                <td colspan="2">Total</td>
                                                <td class="text-center">{{ $totalStock  }}</td>
                                                <td class="text-center">{{ $totalLastStock  }}</td>
                                                <td class="text-center">{{ $totalItem  }}</td>
                                                <td class="text-right">{{ 'Rp. '.number_format($totalPrice , 0, ',', '.') }}</td>
                                                <td class="text-right">{{ 'Rp. '.number_format($totalFundingPrice , 0, ',', '.') }}</td>
                                                <td class="text-right">{{ 'Rp. '.number_format($totalFund , 0, ',', '.') }}</td>
                                                <td class="text-right">{{ 'Rp. '.number_format( $totalProfit , 0, ',', '.')}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
