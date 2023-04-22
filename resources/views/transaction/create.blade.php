<div class="row">
    @foreach ($data as $item)
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card bg-c-6 order-card show-provider" data-id="{{ $item['id'] }}"
                data-category="{{ $item['category_id'] }}">
                <div class="card-body">
                    <span class="badge badge-primary float-right badge-pill">{{ $item['unsold'] }}</span>
                    <h6 class="">{{ $item['name'] }}</h6>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="row provider-list">
        </div>
    </div>
</div>
<div class="row form-section" style="display: none">
    <div class="col-xl-12 col-md-12 col-sm-12">
        <form id="form" name="form">
            @csrf
            <input type="hidden" id="category_id" name="category_id" placeholder="Category">
            <input type="hidden" id="sub_category_id" name="sub_category_id" placeholder="Sub Category">
            <input type="hidden" id="provider_id" name="provider_id" placeholder="Provider">
            <input type="hidden" id="product_id" name="product_id" placeholder="Product">

            <div class="alert alert-light alert-has-icon" style="display: none">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Pengecekan Stok</div>
                    <div class="alert-message"></div>
                </div>
            </div>

            <div class="alert alert-danger" style="display: none">
                <div class="alert-title">Terjadi kesalahan</div>
                <strong class="alert-message"></strong>
            </div>

            <div class="row mb-3">
                <div class="col-xl-12 col-md-12 col-sm-12">
                    <ul class="items list-group">
                    </ul>
                </div>
            </div>
            <div class="button-group" style="display: none">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                Batal</button>
            <button type="submit" id="create" class="btn btn-primary float-right"><i class="fas fa-save"></i> Simpan
                Transaksi</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#create').click(function (e) {
        e.preventDefault();
        $("#create").html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        let form_data = $("#form").serialize();

        $.ajax({
            data: form_data,
            url: "{{ route('transactions.insert') }}",
            type: "POST",
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    $('#form').trigger("reset");
                    $('#modalReporting').modal('hide');
                } else {
                    $(".alert-danger").show()
                    $(".alert-danger").find(".alert-message").html(res.data.error)
                    $("#create").html('<i class="fas fa-save"></i> Simpan Transaksi');
                }
            },
            error: function (data) {
                $("#create").html('<i class="fas fa-save"></i> Simpan Transaksi');
            }
        });
    });

    $(".show-provider").click(function() {
        $('.provider-list').html("")
        $(".alert-light").hide();
        $(".alert-message").html("")
        $(".button-group").hide();
        $(".items").html("")

        var categoryID = $(this).data('category')
        $("#category_id").val(categoryID)

        var subCategoryID = $(this).data('id')
        $("#sub_category_id").val(subCategoryID)

        var getProvider = "{{ route('transactions.getProvider', ['sub-category-id' => 'subCategoryID']) }}"
        getProvider = getProvider.replace('subCategoryID', subCategoryID);

        // check provider by sub category
        $.get(getProvider, function(res, status) {
            if (status == 'success') {
                var html = [];
                if (res.data.length > 0) {
                    let data = res.data
                    let htmlEl = ""
                    data.forEach(e => {
                        var img = `https://placehold.co/800x300.png?text=${e.name}`
                        if (e.logo) {
                            img = e.logo
                        }
                        htmlEl = `
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="card mb-3 p-1 select-provider" data-id="${e.id}" style="border: 2px solid ${e.color}">
                                <img src="${img}" style="height:50px" class="card-img-top" alt="${e.name}">
                                <div class="card-body p-0 pt-2" >
                                    <h6 class="text-center">${e.name}</h6>
                                </div>
                            </div>
                        </div>`
                        html.push(htmlEl)
                    });
                }
                $('.provider-list').html(html)
                $(".select-provider").click(function() {
                    //start state
                    $(".items").html("")
                    $(".button-group").hide();
                    var providerID = $(this).data('id')
                    $("#provider_id").val(providerID)


                    $(".form-section").show();

                    // check stock by category, sub category and provider
                    var getStock = "{{ route('transactions.stock', ['category' => 'categoryID', 'sub-category' => 'subCategoryID', 'provider' => 'providerID'] ) }}"
                    getStock = getStock.replace('categoryID', categoryID);
                    getStock = getStock.replace('subCategoryID', subCategoryID);
                    getStock = getStock.replace('providerID', providerID);
                    getStock = getStock.replaceAll('&amp;', '&')
                    $.get(getStock, function(stockRes, stockStatus) {
                        if (stockStatus == 'success') {
                            if (stockRes.data.length > 0) {
                                var stocked = stockRes.data[0]
                                var message = ``;
                                var isItem = false
                                if (stocked > 0) {
                                    message = `Terdapat <b>${stocked}</b> lagi di dalam stok, dapat melakukan transaksi.`
                                    $("#create").removeAttr('disabled')
                                    isItem = true
                                } else {
                                    message = `Terdapat <b>${stocked}</b> lagi di dalam stok, harap lakukan penambahan jumlah stok. Jika perlu bantuan segera hubungi via whatsaap dengan menekan tombol hijau di bawah.
                                    <br><button type="button" class="btn btn-success float-right mt-2" data-category="${categoryID}" data-subcategory="${subCategoryID}" data-provider="${providerID}" onclick="sendNotif(this)"><i class="fab fa-telegram"></i> Kirim Pesan</button>`
                                    $("#create").attr('disabled','disabled')
                                }
                                $(".alert-light").show();
                                $(".alert").find(".alert-message").html(message)

                                if (isItem) {
                                    var getItem = `{{ route('transactions.items', ['category' => 'categoryID', 'sub-category' => 'subCategoryID', 'provider' => 'providerID'] ) }}`
                                    getItem = getItem.replace('categoryID', categoryID);
                                    getItem = getItem.replace('subCategoryID', subCategoryID);
                                    getItem = getItem.replace('providerID', providerID);
                                    getItem = getItem.replaceAll('&amp;', '&')

                                    $.get(getItem, function(res, status) {
                                        if (status == 'success') {
                                            if (res.data.length > 0) {
                                                var items = res.data
                                                var html = []
                                                var itemEl = ''
                                                items.forEach(el => {
                                                    var buttonWA = ``
                                                    var badge = `<span class="badge badge-success badge-pill">${el.available}</span>`
                                                    if(el.available <= 0) {
                                                        buttonWA = `</br></br><a class="btn btn-success" target="_blank" href="https://wa.me/+6285271404170?text=Stok+%2AKartu+Perdana+Prabayar+Provider+Telkomsel%2A+di+Konter+%2AABC%2A+ada+%2A0%2A.+%0D%0ANominal+%3A+%2A${el.quota}+${el.unit}%2A%0D%0ADeskripsi+%3A+%2A${el.description}%2A%0D%0ATolong+ditambah+lagi+ya+agar+proses+transaksi+penjualan+terus+berjalan."><i class="fab fa-whatsapp"></i> Kirim Pesan</a>`
                                                        badge = `<span class="badge badge-danger badge-pill">${el.available}</span>`
                                                    }

                                                    itemEl = `
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${el.id}">
                                                        <p><strong>
                                                            Nominal : ${el.quota} ${el.unit} </br>
                                                            Deskripsi : ${el.description} <br>
                                                            Harga :  Rp ${el.price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")}
                                                            ${buttonWA}
                                                        </p>
                                                        ${badge}
                                                    </strong>
                                                    </li>`

                                                    html.push(itemEl)
                                                });
                                                $(".button-group").show();
                                                $(".items").html(html)

                                                $('.list-group-item').on('click', function() {
                                                    var $this = $(this);
                                                    var $alias = $this.data('alias');
                                                    $('.active').removeClass('active');
                                                    $this.toggleClass('active')

                                                    // Pass clicked link element to another function
                                                    var productID = $this.data('id')
                                                    $("#product_id").val(productID)
                                                })
                                            }
                                        }
                                    })
                                }
                            }
                        }
                    })
                })
            }
        })
    })

    function sendNotif(e) {
        $(e).attr("disabled", "disabled")
        $(e).html('<i class="fas fa-spinner fa-spin"></i> Mengirim pesan...');
        var categoryId = $(e).data('category')
        var subCategoryId = $(e).data('subcategory')
        var providerId = $(e).data('provider')
        var productId = $("#product_id").val()

        $.post(`{{ route('telegram-notif.request') }}`, {
            'product_id' : productId,
            'category_id' : categoryId,
            'sub_category_id': subCategoryId,
            'provider_id': providerId,
            "_token": "{{ csrf_token() }}",
        }).done(function(res) {
            iziToast.success({
                title: res.messageTitle,
                message: res.message,
                position: 'topRight'
            });
            $(e).removeAttr("disabled")
            $(e).html('<i class="fab fa-telegram"></i> Kirim Pesan');
        }).fail(function(xhr) {
            fail(xhr)
        })
    }

    function fail(params) {
        iziToast.error({
            title: params.statusText,
            message: params.responseJSON.message,
            position: 'topRight'
        });
    }
</script>
