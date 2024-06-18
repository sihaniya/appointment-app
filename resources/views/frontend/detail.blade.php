<x-main-layout>

    <x-slot:title>
        Custom Title
    </x-slot>

    <x-slot:metaTags>
        <meta name="description" content="">
        <meta name="keywords" content="">
    </x-slot>


    {{-- content --}}
    <section class="article-section">
        <div class="card app-card mb-3">
            <div class="card-body">
                <h5 class="card-title mb-3">{{ $article->name }}</h5>
                <div class="app-code-editor">
                    {!! \Illuminate\Support\Str::markdown($article->long_description) !!}
                </div>
            </div>
        </div>
    </section>
    {{-- content --}}

    @include('frontend.comment')

    <x-slot:afterScripts>
        <script src="{{ asset('assets/js/frontend/comment.js') }}"></script>
        <script>
            var options = {};
            var article_id = '{!! $article->id !!}'
            options.article_id = article_id;
            var cm = new fe_comment(options);
            cm.fetch(article_id);
        </script>
    </x-slot:afterScripts>

    </x-layouts.frontend>
