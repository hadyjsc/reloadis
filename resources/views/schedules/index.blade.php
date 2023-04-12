@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Jadwal Karyawan</h1>
            {{ Breadcrumbs::render('schedules.index') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <a href="{{route('schedules.create')}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-info-circle"></i> Tambah Jadwal</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="table-responsive">
                                    <livewire:table :config="App\Tables\SchedulesTable::class"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
