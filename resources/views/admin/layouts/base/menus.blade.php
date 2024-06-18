@php
    $menus = [
        [
            'name' => 'Navigation',
            'divider' => true,
        ],
        [
            'name' => 'Dashboard',
            'icon' => 'bx bx-grid-alt',
            'url' => 'admin/dashboard',
            'route' => route('admin.dashboard'),
            'divider' => false,
        ],
        // [
        //     'name' => 'Markdown',
        //     'icon' => 'bx bx-grid-alt',
        //     'url' => 'admin/markdown',
        //     'route' => route('admin.markdown'),
        //     'divider' => false,
        // ],
        [
            'name' => 'User',
            'icon' => 'bx bx-user',
            'url' => 'admin/users',
            'route' => route('admin.user'),
            'divider' => false,
        ],
        [
            'name' => 'Appointment',
            'divider' => true,
        ],
        [
            'name' => 'Appointment',
            'icon' => 'bx bx-file',
            'url' => 'admin/appointment',
            'route' => route('admin.appointment'),
            'divider' => false,
        ],
        // [
        //     'name' => 'Article',
        //     'icon' => 'bx bx-file',
        //     'url' => 'admin/articles',
        //     'route' => route('admin.article'),
        //     'divider' => false,
        // ],
    ];
@endphp
@include('admin.layouts.base.sidebar', $menus)
