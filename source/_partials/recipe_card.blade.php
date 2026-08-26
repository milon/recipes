<article class="recipe-card">
    <div class="recipe-card-inner">
        @if ($post->metaImage ?? null)
            <a href="{{ $post->getPath('web') }}" class="recipe-card-image" tabindex="-1" aria-hidden="true">
                <img src="{{ $post->metaImage }}" alt="" loading="lazy">
            </a>
        @endif
        <div class="recipe-card-body">
            @include('_partials.category_tags', [
                'categories' => $post->categories ?? [],
                'limit' => 2,
                'wrapperClass' => 'recipe-card-tags',
            ])
            <h2 class="recipe-card-title">
                <a href="{{ $post->getPath('web') }}" class="recipe-card-title-link">{{ $post->title }}</a>
            </h2>
            @if ($post->excerpt ?? null)
                <p class="recipe-card-excerpt">
                    <a href="{{ $post->getPath('web') }}" class="recipe-card-excerpt-link">{{ $post->excerpt }}</a>
                </p>
            @endif
            <p class="recipe-card-meta">
                পোস্ট করা হয়েছে · {{ $page->banglaDate($post->date) }}
            </p>
        </div>
    </div>
</article>
