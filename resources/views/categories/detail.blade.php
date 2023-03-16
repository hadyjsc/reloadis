@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail</h1>
        {{ Breadcrumbs::render('show', $model) }}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <td>: {{$model->id}}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>: {{$model->type->name}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>: {{$model->name}}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>: {{$model->created_at}}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>: {{$model->updated_at}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <form method="post" action="{{ route('categories.delete', $model->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('categories.edit', $model->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
