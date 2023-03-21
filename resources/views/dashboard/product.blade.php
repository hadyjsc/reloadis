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
                    <div class="card-body">
                        "Product"
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
