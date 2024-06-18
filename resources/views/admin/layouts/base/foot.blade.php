<script type="text/javascript">
    var ADMIN_HOST_URL = "{{ url('/admin') }}";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{ asset('assets/libs/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/libs/isloading/jquery.isloading.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/libs/datepicker/js/datepicker-full.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
<script src="{{ asset('assets/libs/lightbox2/js/lightbox.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="{{ asset('assets/js/utils.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script> --}}
<script>
    feather.replace();
</script>
<script src="{{ asset('assets/js/admin/beSettings.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "easeOutBounce",
        "hideEasing": "easeInBack",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    }
</script>
<script>
    $(document).on("click", ".confirm_button", function() {
        var dataHref = $(this).attr("data-href");
        new Swal({
            title: "Are you sure?",
            icon: "warning",
            html: "You won't be able to revert this!" +
                "<br>" +
                '<button type="button" data-href="' + dataHref +
                '" role="button" tabindex="0" class="btn btn-success swalConfirmButton customSwalBtn mt-4 me-2">Yes, delete it!</button>' +
                '<button type="button" role="button" tabindex="0" class="btn btn-secondary swalCancelButton customSwalBtn mt-4">No, keep it</button>',
            showCancelButton: false,
            showConfirmButton: false
        });
    });
    $(document).on("click", ".swalCancelButton", function() {
        Swal.clickDeny();
    });
    @if (Session::has('message'))
        var toastrType = "{{ Session::get('type', 'info') }}"
        var toastrMessage = "{{ Session::get('message') }}";
        // toastr.options.timeOut = 10000;
        // var audio = new Audio('audio.mp3');
        // audio.play();
        switch (toastrType) {
            case 'info':
                toastr.info(toastrMessage);
                break;
            case 'success':
                toastr.success(toastrMessage);
                break;
            case 'warning':
                toastr.warning(toastrMessage);
                break;
            case 'error':
                toastr.error(toastrMessage);
                break;
        }
    @endif
</script>
@stack('after-js')
