@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Types</h1>
            {{ Breadcrumbs::render('sub-categories') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <livewire:table :config="App\Tables\SubCategoriesTable::class"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
