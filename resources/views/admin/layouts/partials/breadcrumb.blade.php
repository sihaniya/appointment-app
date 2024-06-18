<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($page_breadcrumbs as $pb)
            @if ($pb['active'])
                <li class="breadcrumb-item active">{{ $pb['title'] }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $pb['url'] }}">{{ $pb['title'] }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
