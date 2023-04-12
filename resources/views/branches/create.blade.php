@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create</h1>
        {{ Breadcrumbs::render('branches.create') }}
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
                    @if ($message = Session::get('failed'))
                        <div class="alert alert-error">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <form action="{{route('branches.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Nama cabang">
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Location:</strong>
                                    <input type="text" name="location" class="form-control" placeholder="Lokasi cabang">
                                    @error('location')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{route('branches.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
