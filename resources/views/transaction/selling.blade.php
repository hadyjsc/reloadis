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
                                <div class="card bg-c-{{ $i }} order-card">
                                    <div class="card-block">
                                        <h4 class="m-b-20">{{ $data['name'] }}</h4>
                                        @if (Str::lower($key) == 'product')
                                            <h6>Tersedia<span class="f-right">20</span><br></h6>
                                            <h6 class="">Terjual<span class="f-right">351</span></h6>
                                        @endif
                                        <a href="javascript:void(0)" class="stretched-link open-x-modal" data-id="{{ $data['id'] }}" data-target="{{ $data['id'] }}"></a>
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
    <form class="modal-part" id="modal-transaction">
        <div class="form-group">
            <label>Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                <input type="text" class="form-control" placeholder="Email" name="email">
            </div>
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
        </div>
        <div class="form-group mb-0">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                <label class="custom-control-label" for="remember-me">Remember Me</label>
            </div>
        </div>
    </form>
    @section("custom-javascript")
    <script>
        $(".open-x-modal").click(function() {
            var catID = $(this).data("id");
            var url = "{{ route('transactions.getSubCategory', ['category-id' => 'catID']) }}"
            url = url.replace('catID', catID);

            $.ajax(url, function(data) {
                console.log(data);
            })
        })
        // $(".open-x-modal").fireModal({
        //     title: 'Buat Transaksi',
        //     body: $("#modal-transaction"),
        //     footerClass: 'bg-whitesmoke',
        //     autoFocus: false,
        //     onFormSubmit: function(modal, e, form) {
        //         // Form Data
        //         let form_data = $(e.target).serialize();
        //         console.log(form_data)

        //         // DO AJAX HERE
        //         let fake_ajax = setTimeout(function() {
        //             form.stopProgress();
        //             modal.find('.modal-body').prepend(
        //                 '<div class="alert alert-info">Please check your browser console</div>')

        //             clearInterval(fake_ajax);
        //         }, 1500);

        //         e.preventDefault();
        //     },
        //     shown: function(modal, form) {
        //         console.log(form)
        //     },
        //     buttons: [{
        //         text: 'Login',
        //         submit: true,
        //         class: 'btn btn-primary btn-shadow',
        //         handler: function(modal) {}
        //     }]
        // });
    </script>
    @endsection
@endsection
