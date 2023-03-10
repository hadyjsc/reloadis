@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            {{ Breadcrumbs::render('categories') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">
                            <a href="{{route('categories.create')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-info-circle"></i> Create Category</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <livewire:table :config="App\Tables\CategoriesTable::class"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
