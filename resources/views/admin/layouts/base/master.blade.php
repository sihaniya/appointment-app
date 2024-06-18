<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.base.head')
</head>

<body>


    <div class="be-wrapper">
        @include('admin.layouts.base.menus')
        <div class="be-wrapper-right">
            @include('admin.layouts.base.header')
            <div class="be-wrapper-content">@yield('content')</div>
        </div>
    </div>


    @include('admin.layouts.base.foot')
</body>

</html>
