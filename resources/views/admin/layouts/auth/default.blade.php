<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.auth.head')
</head>

<body>
    <div class="be-auth-wrapper">
        <div class="be-auth-content">
            @yield('content')
        </div>
    </div>

    @include('admin.layouts.auth.foot')
</body>

</html>
