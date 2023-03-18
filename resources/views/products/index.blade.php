@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Produk</h1>
            {{ Breadcrumbs::render('products') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">
                            <div class="card-header-form">
                                <a href="{{route('products.create')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-info-circle"></i> Tambah Produk</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <livewire:table :config="App\Tables\ProductsTable::class"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
