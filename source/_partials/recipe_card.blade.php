@php
    $tileServings = $page->formatServings($post->servings ?? null);
    $tilePrepTime = $page->formatPrepTime($post->prepMinutes ?? null);
    $tileWebp = responsive_image_url($post->metaImage ?? null, 'tile-640');
@endphp

<article class="recipe-tile">
    @if ($post->metaImage ?? null)
        <a href="{{ $post->getPath('web') }}" class="recipe-tile-photo" tabindex="-1" aria-hidden="true">
            <picture>
                @if ($tileWebp)
                    <source srcset="{{ $tileWebp }}" type="image/webp">
                @endif
                <img src="{{ $post->metaImage }}" alt="" width="640" height="480" loading="lazy" decoding="async">
            </picture>
        </a>
    @endif

    <div class="recipe-tile-body">
        @include('_partials.category_tags', [
            'categories' => $post->categories ?? [],
            'limit' => 2,
            'wrapperClass' => 'recipe-tile-tags',
        ])

        <h2 class="recipe-tile-title">
            <a href="{{ $post->getPath('web') }}" class="recipe-tile-link">{{ $post->title }}</a>
        </h2>

        @if ($post->excerpt ?? null)
            <p class="recipe-tile-excerpt">{{ $post->excerpt }}</p>
        @endif

        @if ($tileServings || $tilePrepTime)
            <ul class="recipe-facts recipe-facts--compact">
                @if ($tileServings)
                    <li>
                        @include('_components.icon', ['name' => 'users', 'class' => 'recipe-fact-icon'])
                        {{ $tileServings }}
                    </li>
                @endif

                @if ($tilePrepTime)
                    <li>
                        @include('_components.icon', ['name' => 'clock', 'class' => 'recipe-fact-icon'])
                        {{ $tilePrepTime }}
                    </li>
                @endif
            </ul>
        @endif
    </div>
</article>
