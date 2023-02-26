@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Types</h1>
            {{ Breadcrumbs::render('types') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <pre>
                        @php
                        print_r($types);
                        @endphp
                        </pre>
                        {{-- <div class="table-responsive"> --}}
                            <livewire:table :config="App\Tables\TypesTable::class"/>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
