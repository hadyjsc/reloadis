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
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i> Export ke Excel</a>
                                <a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-pdf"></i> Export ke PDF</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <livewire:table :config="App\Tables\TransactionReportTable::class"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
