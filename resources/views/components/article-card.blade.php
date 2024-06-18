@isset($article)
    <div class="card app-card mb-3">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $article->name }}</h5>
            <p class="card-text">{{ $article->short_description }}</p>
            <a href="{{ route('article.detail', ['slug' => $article->slug]) }}" class="btn btn-link">Read more...</a>
        </div>
    </div>
@endisset
