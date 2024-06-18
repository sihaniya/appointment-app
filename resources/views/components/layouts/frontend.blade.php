<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ $metaTags ?? '' }}

    <title>{{ $title ?? '' }}</title>

    <link rel="apple-touch-icon" href="{{ asset('assets/frontend/images/favicon.ico') }}">
    <link rel="icon" href="{{ asset('assets/frontend/images/favicon.ico') }}" type="image/gif" sizes="16x16">

    {{ $beforeStyles ?? '' }}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    {{ $afterStyles ?? '' }}
</head>

<body>

    <x-layouts.navbar></x-layouts.navbar>

    <main class="container mt-4">
        <div class="fe-content">
            <div class="row">
                <div class="col-12 col-md-9">
                    {{ $slot }}
                </div>
                <div class="col-12 col-md-3">
                    <div class="card app-card mb-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Categories</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="fe-footer shadow-sm">
        <div class="container text-center">
            Copyright @ 2024 wdcoders.com. All rights reserved.
        </div>
    </footer>

    <script type="text/javascript">
        var HOST_URL = "{{ url('/') }}";
    </script>
    {{ $beforeScripts ?? '' }}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="{{ asset('assets/js/utils.js') }}"></script>
    {{ $afterScripts ?? '' }}
</body>

</html>
