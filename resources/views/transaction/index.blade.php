@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Rekap Transaksi</h1>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <livewire:table :config="App\Tables\TransactionReportTable::class"/>
            </div>
        </div>
    </section>
@endsection()
