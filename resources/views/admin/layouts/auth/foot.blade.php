<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
