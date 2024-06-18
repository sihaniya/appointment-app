<aside class="be-wrapper-sidebar" id="beSidebar">
    <div class="be-sidebar-brand">
        <span class="align-middle">Administrator</span>
    </div>
    <ul class="be-sidebar-nav">
        @foreach ($menus as $menu)
            @if ($menu['divider'])
                <li class="be-sidebar-divider">{{ $menu['name'] }}</li>
            @endif
            @if (!$menu['divider'])
                <li
                    class="be-sidebar-item {{ request()->is($menu['url']) || request()->is($menu['url'] . '/*') ? 'active' : '' }}">
                    <a href="{{ $menu['route'] }}" class="be-sidebar-link">
                        <i class='{{ $menu['icon'] }}'></i>
                        <span>{{ $menu['name'] }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</aside>
