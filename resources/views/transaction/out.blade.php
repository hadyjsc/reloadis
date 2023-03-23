@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1><a href="{{ route('transactions.selling') }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> </a> Prosess Penjualan</h1>
        </div>
        <div class="row">
            @if ( count($subCategory) > 0)
                @foreach ($subCategory as $item)
                    <div class="col-xl-3 col-md-6 col-sm-6">
                        <div class="card bg-c-1 order-card">
                            <div class="card-block">
                                <h4 class="m-b-20">{{ $item->name }}</h4>
                                <h6>Tersedia<span class="f-right">20</span><br></h6>
                                <a href="{{ route('transactions.out', ["category-id" => $item->category_id, "sub-category-id" => $item->id, "name" => $item->name ] )}}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($provider as $item)
                    <div class="col-xl-2 col-md-3 col-sm-3">
                        <div class="card bg-c-1 order-card">
                            <div class="card-block">
                                <h4 class="m-b-20">{{ $item->name }}</h4>
                                <h6>Tersedia<span class="f-right">20</span><br></h6>
                                <a href="{{ route('transactions.out', ["category-id" => $_GET["category-id"], "provider-id" => $item->id, "provider" => $item->name ] )}}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        @isset($_GET["provider"])
        <div class="row">
            <div class="col-xl-12">
                <h2 class="section-title">{{ $_GET["provider"] }}</h2>

            </div>
        </div>
        @endisset
    </section>
@endsection()
