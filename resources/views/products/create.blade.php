@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create</h1>
        {{ Breadcrumbs::render('products.create') }}
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
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <form action="{{route('products.insert')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Category</strong>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($category as $data)
                                        <option value="{{$data->id}}">
                                            {{$data->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Sub Category</strong>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="">-- Select Sub Category --</option>
                                        @foreach ($subcategory as $data)
                                        <option value="{{$data->id}}">
                                            {{$data->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('sub_category_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Provider</strong>
                                    <select name="provider_id" id="provider_id" class="form-control">
                                        <option value="">-- Select Provider --</option>
                                        @foreach ($provider as $data)
                                        <option value="{{$data->id}}">
                                            {{$data->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('provider_id')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Nominal:</strong>
                                            <input type="text" id="quota" name="quota" class="form-control" placeholder="Nominal contoh: 2/3">
                                            @error('quota')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Satuan:</strong>
                                            <input type="text" id="unit" name="unit" class="form-control" placeholder="Satuan nominal, contoh GB/Hari">
                                            @error('unit')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Deskripsi:</strong>
                                    <input type="text" id="description" name="description" class="form-control" placeholder="Deskripsi">
                                    @error('description')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Harga:</strong>
                                    <input type="text" id="price" name="price" class="form-control" placeholder="Harga Jual">
                                    @error('price')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Harga Modal:</strong>
                                            <input type="text" id="fund" name="fund" class="form-control" placeholder="Harga Modal">
                                            @error('fund')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Batas Berlaku Modal:</strong>
                                            <input type="text" id="fund_date" name="fund_date" class="form-control" placeholder="Masa Berlaku Harga Modal">
                                            @error('fund_date')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{route('products.index')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</a>
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
