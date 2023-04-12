@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail</h1>
        {{ Breadcrumbs::render('branches.show', $model) }}
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
                                <th>Nama</th>
                                <td>: {{$model->name}}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>: {{$model->location}}</td>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <td>: {{$model->image}}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>: {{$model->created_at}}</td>
                            </tr>
                            <tr>
                                <th>Created By</th>
                                <td>: {{$model->created_by}}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>: {{$model->updated_at}}</td>
                            </tr>
                            <tr>
                                <th>Updated By</th>
                                <td>: {{$model->updated_by}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <form method="post" action="{{ route('branches.delete', $model->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('branches.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</a>
                            <a href="{{route('branches.edit', $model->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
