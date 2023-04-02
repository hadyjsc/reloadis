<div class="row">
    @foreach ($banks as $item)
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card img-fluid selected-bank" data-id="{{ $item['id'] }}">
                <img class="card-img" src="{{ $item['logo'] }}" alt="Logo {{ $item['name'] }}" style="height:60px">
                <div class="card-img-overlay text-center text-white">
                    {{-- <h4 class="">{{ $item['name'] }}</h4> --}}
                    <label class="bank-name" style="display: none">{{ $item['name'] }}</label>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row form-section" style="display: none">
    <div class="col-xl-12 col-md-12 col-sm-12">
        <form id="form" name="form">
            @csrf
            <input value="{{ old('bank_id') }}" type="text" class="form-control bank_id" name="bank_id" style="display: none">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Pengirim:</strong>
                        <input value="{{ old('sender') }}" type="text" class="form-control" name="sender"
                            placeholder="Nama Pengirim">
                        @error('sender')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nomor Rekening:</strong>
                        <input value="{{ old('bank_account') }}" type="text" class="form-control" name="bank_account"
                            placeholder="Nomor Rekening">
                        @error('bank_account')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Penerima:</strong>
                        <input value="{{ old('receiver') }}" type="text" class="form-control" name="receiver"
                            placeholder="Nama Penerima">
                        @error('receiver')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jumlah Uang:</strong>
                        <input value="{{ old('amount') }}" type="text" class="form-control" name="amount"
                            placeholder="Jumlah Uang">
                        @error('receiver')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                <button type="submit" id="create" class="btn btn-primary float-right"><i class="fas fa-save"></i> Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(".selected-bank").click(function(e) {
        var bankId = $(this).data('id')
        var bankName = $(this).find('label.bank-name').html()

        $(".selected-bank").removeClass('bg-warning')
        $(this).addClass('bg-warning')

        $('.bank_id').val(bankId)

        $(".form-section").show()
    })

    $('#create').click(function (e) {
        e.preventDefault();
        $("#create").html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        let form_data = $("#form").serialize();

        $.ajax({
            data: form_data,
            url: "{{ route('transactions.transferStore') }}",
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
</script>
