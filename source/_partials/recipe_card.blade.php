<article class="recipe-card">
    <div class="recipe-card-inner">
        @if ($post->metaImage ?? null)
            <a href="{{ $post->getPath('web') }}" class="recipe-card-image" tabindex="-1" aria-hidden="true">
                <img src="{{ $post->metaImage }}" alt="" loading="lazy">
            </a>
        @endif
        <div class="recipe-card-body">
            <p class="recipe-card-meta">{{ $page->banglaDate($post->date) }}</p>
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
            <a class="recipe-card-action" href="{{ $post->getPath('web') }}">
                রেসিপি পড়ুন
                @include('_components.icon', ['name' => 'chevron-right', 'class' => 'icon--sm'])
            </a>
        </div>
    </div>
</article>
