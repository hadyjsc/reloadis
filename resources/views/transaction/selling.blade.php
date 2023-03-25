@extends('layouts.app-stisla')

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
                            <div class="col-xl-3 col-md-6 col-sm-6">
                                <div class="card bg-c-{{ $i }} order-card open-x-modal"
                                    data-id="{{ $data['id'] }}"
                                    data-target="{{ $data['id'] }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    data-bs-whatever="@mdo">
                                    <div class="card-block">
                                        <h4 class="m-b-20">{{ $data['name'] }}</h4>
                                        @if (Str::lower($key) == 'product')
                                            <h6>Tersedia<span class="f-right">20</span><br></h6>
                                            <h6 class="">Terjual<span class="f-right">351</span></h6>
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
            var url = "{{ route('transactions.getSubCategory', ['category-id' => 'catID']) }}"
            url = url.replace('catID', catID);

            $.get(url, function(res, status) {
                if (status == 'success') {
                    $("#modalReporting").modal('show').find('.modal-body').html(res);
                }
            })
        })
    </script>
@endsection
@endsection
