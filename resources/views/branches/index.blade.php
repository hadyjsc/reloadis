@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Cabang</h1>
            {{ Breadcrumbs::render('branches.index') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <a href="{{route('branches.create')}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-info-circle"></i> Tambah Cabang</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="table-responsive">
                                    <livewire:table :config="App\Tables\BranchesTable::class"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
