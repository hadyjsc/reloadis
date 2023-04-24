@extends('layouts.app-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            {{ Breadcrumbs::render('dashboard') }}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info">Add your dashboard here!!</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
