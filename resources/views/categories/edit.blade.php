@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail</h1>
        {{ Breadcrumbs::render('edit', $model) }}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <form action="{{route('categories.update', $model->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Type</strong>
                                    <select name="type_id" id="country-dropdown" class="form-control">
                                        <option value="">-- Select Type --</option>
                                        @foreach ($type as $data)
                                            @if ($data->id == $model->type_id)
                                                <option selected="selected" value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>
                                            @else
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" class="form-control" value="{{$model->name}}" placeholder="Category name">
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <a href="{{route('categories.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
