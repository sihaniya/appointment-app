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
        {{-- <div>
            @foreach ($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div> --}}
        <div class="fe-pagination">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    {{-- content --}}



    <x-slot:afterScripts>
        <script src="{{ asset('assets/js/frontend/home.js') }}"></script>
        <script>
            var fh = new fe_home();
            fh.fetch_articles();
        </script>
    </x-slot:afterScripts>

    </x-layouts.frontend>
