<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('title')</title>

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
<link rel="apple-touch-icon" href="{{ asset('assets/frontend/images/favicon.ico') }}">
<link rel="icon" href="{{ asset('assets/frontend/images/favicon.ico') }}" type="image/gif" sizes="16x16">
<meta name="apple-mobile-web-app-title" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('meta-tags')

<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet"href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">



<link href="{{ asset('assets/libs/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">


{{-- @vite(['resources/scss/app.scss']) --}}
@vite(['resources/scss/app.scss', 'resources/js/app.js'])
@stack('after-styles')
