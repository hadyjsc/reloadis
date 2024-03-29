<!-- General JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{asset('assets/js/stisla.js')}}"></script>

<!-- JS Libraies -->
<script src="{{asset('assets/vendor/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('assets/vendor/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('assets/vendor/owl.carousel/dist/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/vendor/summernote/dist/summernote-bs4.js')}}"></script>
<script src="{{asset('assets/vendor/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
<script src="{{asset('assets/vendor/izitoast/dist/js/iziToast.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Template JS File -->
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/page/bootstrap-modal.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/page/modules-toastr.js')}}"></script>

<!-- Page Specific JS File -->
{{-- <script src="{{asset('assets/js/page/index.js')}}"></script> --}}
<script>
    $('[data-toggle="tooltip"]').tooltip()
</script>
<livewire:scripts />
<script>
    Livewire.on('datepicker:script', function() {
        $('.daterange-cus').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            autoUpdateInput: false,
        });

        $('.daterange-cus').on('apply.daterangepicker', function(ev, picker) {
            var val = picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD');
            Livewire.emit('datepicker:script:set', 'date_time_filter', val)
            $(this).val(val);
        });

        $('.daterange-cus').on('cancel.daterangepicker', function(ev, picker) {
            Livewire.emit('datepicker:script:set', 'date_time_filter', '')
            $(this).val('');
        });
    });
</script>
