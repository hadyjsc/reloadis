@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create</h1>
        {{ Breadcrumbs::render('product-items.create') }}
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
                    <form action="{{route('product-items.insert')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Product</strong>
                                    <select name="product_id" id="country-dropdown" class="form-control">
                                        <option value="">-- Select Product --</option>
                                        @foreach ($product as $data)
                                        <option value="{{$data->id}}">
                                            {{$data->provider->name}} - {{$data->category->name}} - {{$data->quota}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nomor Seri:</strong>
                                    <input type="text" name="serial_number" class="form-control" placeholder="Nomor Seri">
                                    @error('serial_number')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{route('product-items.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</a>
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
