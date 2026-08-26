<article class="recipe-card">
    <a href="{{ $post->getPath('web') }}" class="recipe-card-link">
        @if ($post->metaImage ?? null)
            <div class="recipe-card-image">
                <img src="{{ $post->metaImage }}" alt="{{ $post->title }}" loading="lazy">
            </div>
        @endif
        <div class="recipe-card-body">
            @include('_partials.category_tags', [
                'categories' => $post->categories ?? [],
                'limit' => 2,
                'wrapperClass' => 'recipe-card-tags',
            ])
            <h2 class="recipe-card-title">{{ $post->title }}</h2>
            @if ($post->excerpt ?? null)
                <p class="recipe-card-excerpt">{{ $post->excerpt }}</p>
            @endif
            <p class="recipe-card-meta">
                পোস্ট করা হয়েছে · {{ $page->banglaDate($post->date) }}
            </p>
        </div>
    </a>
</article>
