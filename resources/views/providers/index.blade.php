@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Provider</h1>
            {{ Breadcrumbs::render('providers') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <a href="{{route('providers.create')}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-info-circle"></i> Tambah Provider</a>
                                {{-- <a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-excel"></i> Export ke Excel</a> --}}
                                {{-- <a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-file-pdf"></i> Export ke PDF</a> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="table-responsive">
                                    <livewire:table :config="App\Tables\ProvidersTable::class"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
