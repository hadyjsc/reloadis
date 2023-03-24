<div class="row">
    @foreach ($data as $item)
    <div class="col-xl-6 col-md-12 col-sm-12">
        <div class="card bg-c-1 order-card provider" data-id="{{ $item['id'] }}">
            <div class="card-block">
                <h4 class="m-b-20">{{ $item['name'] }}</h4>
                <h6>Tersedia<span class="f-right">20</span><br></h6>
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
<script>
    $(".provider").click(function() {
        var subCategoryID = $(this).data('id')
        var getProvider = "{{ route('transactions.getProvider', ['sub-category-id' => 'subCategoryID']) }}"
        getProvider = getProvider.replace('subCategoryID', subCategoryID);

        $.get(getProvider, function(res, status) {
            if (status == 'success') {
                var html = [];
                if (res.data.length > 0) {
                    let data = res.data
                    let htmlEl = ""
                    data.forEach(e => {
                        htmlEl = `
                        <div class="col-xl-6 col-md-12 col-sm-12">
                            <div class="card mb-3" style="border-color:${e.color}">
                                <img src="${e.logo}" style="height:60px" class="card-img-top" alt="${e.name}">
                                <div class="card-body">
                                    <h5 class="">${e.name}</h5>
                                </div>
                            </div>
                        </div>`
                        html.push(htmlEl)
                    });
                }


                $('.provider-list').html(html)
            }
        })
    })
</script>

{{-- <form>
    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">Recipient:</label>
        <input type="text" class="form-control" id="recipient-name" value="">
    </div>
    <div class="mb-3">
        <label for="message-text" class="col-form-label">Message:</label>
        <textarea class="form-control" id="message-text"></textarea>
    </div>
    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
    <button type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
</form> --}}
