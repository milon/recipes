@php
    $heroRotate = $heroRotate ?? false;
    $heroKicker = $heroKicker ?? $page->localizedSiteName();
    $heroTitle = $heroTitle ?? ($page->title ?: $page->localizedSiteName());
    $heroSummary = $heroSummary ?? array_filter([$page->subtitle ?: $page->localizedSiteDescription()]);
    $heroFacts = $heroFacts ?? [];
    $heroActions = $heroActions ?? [];

    $heroPhoto = $heroRotate
        ? $page->heroBackground()
        : ($heroImage ?? ($page->image ?: $page->randomBackground()));
    preg_match('/bg-(\d+)\.jpg$/', $heroPhoto, $heroPhotoMatch);
    $heroFirst = $heroRotate ? (int) ($heroPhotoMatch[1] ?? 1) : null;
    $heroNext = $heroRotate ? ($heroFirst % $page->backgroundCount) + 1 : null;
    $heroWebpSrcset = responsive_image_srcset($heroPhoto);
    $heroDimensions = local_image_dimensions($heroPhoto);
    $heroNextPhoto = $heroRotate ? $page->backgroundImage($heroNext) : null;
    $heroNextDimensions = local_image_dimensions($heroNextPhoto);
@endphp

<section class="hero {{ $heroRotate ? 'hero--rotating' : 'hero--page' }}">
    <div class="container">
        <div
            class="hero-frame"
            @if ($heroRotate)
                data-hero-rotate="{{ $page->backgroundCount }}"
                data-hero-next="{{ $heroNext }}"
                data-hero-src="{{ $page->backgroundImage('{n}') }}"
                data-hero-webp-src="{{ responsive_image_path($page->backgroundImage('{n}'), 'detail-1280') }}"
                data-hero-webp-small-src="{{ responsive_image_path($page->backgroundImage('{n}'), 'detail-640') }}"
                data-hero-webp-mobile-src="{{ responsive_image_path($page->backgroundImage('{n}'), 'detail-768') }}"
            @endif
        >
            <div class="hero-stage">
                <picture>
                    @if ($heroWebpSrcset)
                        <source
                            srcset="{{ $heroWebpSrcset }}"
                            sizes="(min-width: 1200px) 1110px, calc(100vw - 30px)"
                            type="image/webp"
                        >
                    @endif
                    <img
                        class="hero-photo is-visible"
                        src="{{ $heroPhoto }}"
                        alt=""
                        @if ($heroDimensions)
                            width="{{ $heroDimensions['width'] }}"
                            height="{{ $heroDimensions['height'] }}"
                        @endif
                        fetchpriority="high"
                        decoding="async"
                    >
                </picture>
                @if ($heroRotate)
                    <picture>
                        <source
                            sizes="(min-width: 1200px) 1110px, calc(100vw - 30px)"
                            type="image/webp"
                        >
                        <img
                            class="hero-photo"
                            alt=""
                            @if ($heroNextDimensions)
                                width="{{ $heroNextDimensions['width'] }}"
                                height="{{ $heroNextDimensions['height'] }}"
                            @endif
                            decoding="async"
                        >
                    </picture>
                @endif
            </div>

            <div class="hero-panel">
                <p class="editorial-kicker">{{ $heroKicker }}</p>
                <h1 class="hero-title">{{ $heroTitle }}</h1>

                @if (count($heroSummary))
                    <div class="hero-summary">
                        @foreach ($heroSummary as $heroParagraph)
                            <p>{{ $heroParagraph }}</p>
                        @endforeach
                    </div>
                @endif

                @if (count($heroFacts))
                    <ul class="recipe-facts">
                        @foreach ($heroFacts as $heroFact)
                            <li>
                                @include('_components.icon', ['name' => $heroFact['icon'], 'class' => 'recipe-fact-icon'])
                                {{ $heroFact['label'] }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if (count($heroActions))
                    <div class="hero-actions">
                        @foreach ($heroActions as $heroAction)
                            <a
                                class="hero-action{{ ($heroAction['variant'] ?? '') === 'quiet' ? ' hero-action--quiet' : '' }}"
                                href="{{ $heroAction['url'] }}"
                            >{{ $heroAction['label'] }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
