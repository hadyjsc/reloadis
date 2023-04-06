<div class="row">
    @php
        $i = 1
    @endphp
    @foreach ($data as $item)
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card bg-c-6 order-card show-item" data-id="{{ $item['id'] }}"
                data-category="{{ $item['category_id'] }}">
                <div class="card-body">
                    <span class="badge badge-primary float-right badge-pill badge-stock">{{ $item['unsold'] }}</span>
                    <h6 class="">{{ $item['name'] }}</h6>
                </div>
            </div>
        </div>
        @if ($i == count($data))
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card bg-c-4 order-card show-manual-form" data-id="{{ $item['id'] }}"
                data-category="{{ $item['category_id'] }}">
                <div class="card-body">
                    <h6 class="">Masukan Manual</h6>
                </div>
            </div>
        </div>
        @endif
        @php
            $i++
        @endphp
    @endforeach
</div>
<div class="row" id="manual-form">
    <div class="col-xl-12 col-md-12 col-sm-12">
        <form id="form" name="form">
            @csrf
            @method('POST')
            <div class="manual-form" style="display: none">
                <input type="hidden" id="category_id" value="{{ $category->id }}" name="category_id" placeholder="Category">
                <input type="hidden" id="sub_category_id" name="sub_category_id" placeholder="Sub Category">
                <input type="hidden" id="product_id" name="product_id" placeholder="Product">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nama Aplikasi:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Nama Aplikasi">
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nominal:</strong>
                            <input type="text" name="quota" class="form-control" placeholder="Nominal">
                            @error('quota')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Satuan:</strong>
                            <input type="text" name="unit" class="form-control" placeholder="Satuan nominal, contoh GB/Hari, IDR">
                            @error('unit')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Deskripsi:</strong>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Deskripsi">
                            @error('description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Harga:</strong>
                            <input type="text" id="price" name="price" class="form-control" placeholder="Harga Jual">
                            @error('price')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-xl-12 col-md-12 col-sm-12">
                    <ul class="items list-group">
                    </ul>
                </div>
            </div>

            <div class="button-group">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                Batal</button>
            <button type="submit" id="create" class="btn btn-primary float-right" style="display: none"><i class="fas fa-save"></i> Simpan
                Transaksi</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(".show-item").click(function() {
        $(".manual-form").hide()
        $("#create").hide()
        $(".items").html(null)
        var id = $(this).data('id')

        var categoryID = $(this).data('category')
        $("#category_id").val(categoryID)

        var subCategoryID = $(this).data('id')
        $("#sub_category_id").val(subCategoryID)

        var url = "{{ route('topup.getItem', ['sub-category-id' => 'subCategoryID']) }}"
        url = url.replace('subCategoryID', id);

        $.get(url, function(res, status) {
            if (status == 'success') {
                if (res.data.length > 0) {
                    var items = res.data
                    var html = []
                    var itemEl = ''
                    var totalAvailable = 0
                    items.forEach(el => {
                        var buttonWA = ``
                        var badge = `<span class="badge badge-success badge-pill">${el.available}</span>`
                        if(el.available <= 0) {
                            buttonWA = `</br></br><a class="btn btn-success" target="_blank" href="https://wa.me/+6285271404170?text=Stok+%2AKartu+Perdana+Prabayar+Provider+Telkomsel%2A+di+Konter+%2AABC%2A+ada+%2A0%2A.+%0D%0ANominal+%3A+%2A${el.quota}+${el.unit}%2A%0D%0ADeskripsi+%3A+%2A${el.description}%2A%0D%0ATolong+ditambah+lagi+ya+agar+proses+transaksi+penjualan+terus+berjalan."><i class="fab fa-whatsapp"></i> Kirim Pesan</a>`
                            badge = `<span class="badge badge-danger badge-pill">${el.available}</span>`
                        }

                        var nf = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency:'IDR',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        });

                        var productID = el.available ? el.id : null;

                        itemEl = `
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${productID}">
                            <p><strong>
                                Nominal : ${nf.format(el.quota)} </br>
                                Deskripsi : ${el.description} <br>
                                Harga :  ${nf.format(el.price)}
                                ${buttonWA}
                            </p>
                            ${badge}
                        </strong>
                        </li>`
                        totalAvailable =+ el.available
                        html.push(itemEl)
                    });
                    $(".button-group").show();
                    $(".items").html(html)

                    $('.list-group-item').on('click', function() {
                        var $this = $(this);
                        var $alias = $this.data('alias');
                        $('.active').removeClass('active');
                        $this.toggleClass('active')

                        var productID = $this.data('id')
                        $("#product_id").val(productID)

                        if (totalAvailable > 0) {
                            $("#create").show()
                        }
                    })
                }
            }
        })
    })

    $(".show-manual-form").click(function() {
        $(".manual-form").show()
        var id = $(this).data('id')
        $("#product_id").val(null)
        $(".items").html(null)
        $("#create").show()
    })

    $('#create').click(function (e) {
        e.preventDefault();
        $("#create").html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        let form_data = $("#form").serialize();

        $.ajax({
            data: form_data,
            url: "{{ route('topup.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    iziToast.success({
                        title: res.messageTitle,
                        message: res.message,
                        position: 'topRight'
                    });
                    $('#form').trigger("reset");
                    $('#modalReporting').modal('hide');
                } else {
                    iziToast.error({
                        title: res.messageTitle,
                        message: res.message,
                        position: 'topRight'
                    });
                    $("#create").html('<i class="fas fa-save"></i> Simpan Transaksi');
                }
            },
            error: function (data) {
                iziToast.error({
                    title: data.statusText,
                    message: data.responseJSON.message,
                    position: 'topRight'
                });
                $("#create").html('<i class="fas fa-save"></i> Simpan Transaksi');
            }
        });
    });
</script>
