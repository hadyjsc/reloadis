@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail</h1>
        {{ Breadcrumbs::render('detail', $model) }}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @php
                        echo "Name: ".$model->name;
                    @endphp
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
