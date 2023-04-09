@extends('layouts.counter-stisla')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Transaksi</h1>
            {{ Breadcrumbs::render('transactions.selling') }}
        </div>
        @php
            $i = 1;
        @endphp
        @foreach ($category as $key => $item)
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <h2 class="section-title">{{ $key }}</h2>
                    <div class="row">
                        @foreach ($item as $data)
                            <div class="col-xl-4 col-md-6 col-sm-2">
                                <div class="card bg-c-{{ $i }} order-card open-x-modal"
                                    data-id="{{ $data['id'] }}"
                                    data-target="{{ $data['id'] }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    data-bs-whatever="@mdo"
                                    data-name="{{ Str::lower($key) }}">
                                    <div class="card-block">
                                        <h4 class="m-b-20">{{ $data['name'] }}</h4>
                                        @if (Str::lower($key) == 'product')
                                            <h6>Tersedia<span class="f-right">{{$data['available']}}</span><br></h6>
                                            <h6 class="">Terjual<span class="f-right">{{$data['sold']}}</span></h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    </section>
    <div class="modal fade" id="modalReporting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
                    <a href="javascript:void(0)" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    @section('custom-javascript')
    <script>
        $(".open-x-modal").click(function() {
            var catID = $(this).data("id");
            var catName = $(this).data("name");
            console.log(catID, catName);
            if (catName == "transfer") {
                $.get("{{ route('transfers.index') }}", function (res, status) {
                    if (status == 'success') {
                        $("#modalReporting").modal('show').find('.modal-body').html(res);
                    }
                }).fail(function(xhr) {
                    fail(xhr)
                })
            } else if(catName == "tarik tunai") {
                $.get("{{ route('cash-withdrawals.index') }}", function (res, status) {
                    if (status == 'success') {
                        $("#modalReporting").modal('show').find('.modal-body').html(res);
                    }
                }).fail(function(xhr) {
                    fail(xhr)
                })
            } else if(catName == 'topup') {
                var url = "{{ route('topup.index', ['category-id' => 'catID']) }}";
                url = url.replace('catID', catID);
                $.get(url, function (res, status) {
                    if (status == 'success') {
                        $("#modalReporting").modal('show').find('.modal-body').html(res);
                    }
                }).fail(function(xhr) {
                    fail(xhr)
                })
            } else if(catName == 'bill') {
                var url = "{{ route('bill.index', ['category-id' => 'catID']) }}";
                url = url.replace('catID', catID);

                $.get(url, function (res, status) {
                    if (status == 'success') {
                        $("#modalReporting").modal('show').find('.modal-body').html(res);
                    }

                }).fail(function(xhr) {
                    fail(xhr)
                })
            } else {
                var url = "{{ route('transactions.getSubCategory', ['category-id' => 'catID']) }}"
                url = url.replace('catID', catID);

                $.get(url, function(res, status) {
                    if (status == 'success') {
                        $("#modalReporting").modal('show').find('.modal-body').html(res);
                    }
                }).fail(function(xhr) {
                    fail(xhr)
                })
            }
        })

        function fail(params) {
            iziToast.error({
                title: params.statusText,
                message: params.responseJSON.message,
                position: 'topRight'
            });
        }
    </script>
    @endsection
@endsection
