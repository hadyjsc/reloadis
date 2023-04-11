@if (count($subCategory) > 0)
    <div class="row">
        @foreach ($subCategory as $item)
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card bg-c-6 order-card sub-category" data-id="{{ $item->id }}" data-category="{{ $item->category_id }}">
                <div class="card-body">
                    <h6 class="">{{ $item->name }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row" id="manual-form" style="display: none">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <form id="form" name="form">
                @csrf
                @method('POST')
                <div class="manual-form">
                    <input type="hidden" id="category_id" value="" name="category_id" placeholder="Category">
                    <input type="hidden" id="sub_category_id" value="" name="sub_category_id" placeholder="Category">

                    <div class="row mb-3" id="product" style="display: none">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <strong>Pilih dari transaksi yang pernah berlangsung:</strong>
                            <select name="product_id" id="product_id" class="form-control">
                            </select>
                            @error('product_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nominal:</strong>
                                <input type="text" id="quota" name="quota" class="form-control" placeholder="Nominal">
                                @error('quota')
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

                <div class="button-group">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                    Batal</button>
                <button type="submit" id="create" class="btn btn-primary float-right"><i class="fas fa-save"></i> Simpan
                    Transaksi</button>
                </div>
            </form>
        </div>
    </div>
@else
    <div class="row" id="manual-form">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <form id="form" name="form">
                @csrf
                @method('POST')
                <div class="manual-form">
                    <input type="hidden" id="category_id" value="{{ $category->id }}" name="category_id" placeholder="Category">

                    @if (count($product) > 0)
                    <div class="row mb-3">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <strong>Pilih dari transaksi yang pernah berlangsung:</strong>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="">-- Select Product --</option>
                                @foreach ($product as $data)
                                <option value="{{$data->id}}">
                                    {{$data->unit.' - '. number_format( $data->quota, 0, ',', '.').' - '.$data->description}}
                                </option>
                                @endforeach
                            </select>
                            @error('product_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nominal:</strong>
                                <input type="text" id="quota" name="quota" class="form-control" placeholder="Nominal">
                                @error('quota')
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

                <div class="button-group">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                    Batal</button>
                <button type="submit" id="create" class="btn btn-primary float-right"><i class="fas fa-save"></i> Simpan
                    Transaksi</button>
                </div>
            </form>
        </div>
    </div>
@endif

<script>
    $("#product_id").change(function(e) {
        if ( $(this).val() != "") {
            $("#quota").val('').attr("disabled", "disabled")
            $("#description").val('').attr("disabled", "disabled")
            $("#price").val('').attr("disabled", "disabled")
        } else {
            $("#quota").removeAttr("disabled").val("")
            $("#description").removeAttr("disabled").val("")
            $("#price").removeAttr("disabled").val("")
        }

    })

    $(".sub-category").click(function(e) {
        var $this = $(this);
        var $alias = $this.data('alias');
        $(".sub-category").addClass('bg-c-6')
        $this.removeClass('bg-c-6').addClass('bg-c-2');

        $("#manual-form").show();
        $('#form').trigger("reset");
        $("#quota").removeAttr("disabled").val("")
        $("#description").removeAttr("disabled").val("")
        $("#price").removeAttr("disabled").val("")

        // Pass clicked link element to another function
        var category = $this.data('category')
        var subCategory = $this.data('id')
        var description = $this.find('h6').html()

        $("#category_id").val(category)
        $("#sub_category_id").val(subCategory)
        $("#description").val(description)


        var getProduct = "{{ route('bill.getItem', ['category' => 'categoryID', 'sub-category-id' => 'subCategoryID']) }}"
        getProduct = getProduct.replace('categoryID', category);
        getProduct = getProduct.replace('subCategoryID', subCategory);
        getProduct = getProduct.replaceAll('&amp;', '&')

        // check provider by sub category
        $.get(getProduct, function(res, status) {
            if (status == 'success' && res.data.length > 0) {
                $("#product").show()
                var data = res.data
                var html = "<option value>-- Select Product --</option>"
                data.forEach(element => {
                    html += `<option value='${element.id}'>${element.unit} - ${element.quota} - ${element.description}</option>`
                });

                $("#product_id").html(html)
            } else {
                $("#product").hide()
                $("#product_id").html(null)
            }

        })
    })

    $("#create").click(function(e) {
        e.preventDefault();
        $("#create").html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        let form_data = $("#form").serialize();
        $.ajax({
            data: form_data,
            url: "{{ route('bill.store') }}",
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
    })


</script>
