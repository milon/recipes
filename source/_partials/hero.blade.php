@php
    $heroRotate = $heroRotate ?? false;
    $heroKicker = $heroKicker ?? $page->siteName;
    $heroTitle = $heroTitle ?? ($page->title ?: $page->siteName);
    $heroSummary = $heroSummary ?? array_filter([$page->subtitle ?: $page->siteDescription]);
    $heroFacts = $heroFacts ?? [];
    $heroActions = $heroActions ?? [];

    $heroFirst = $heroRotate ? rand(1, $page->backgroundCount) : null;
    $heroNext = $heroRotate ? ($heroFirst % $page->backgroundCount) + 1 : null;
    $heroPhoto = $heroRotate
        ? $page->backgroundImage($heroFirst)
        : ($heroImage ?? ($page->image ?: $page->randomBackground()));
@endphp

<section class="hero {{ $heroRotate ? 'hero--rotating' : 'hero--page' }}">
    <div class="container">
        <div
            class="hero-frame"
            @if ($heroRotate)
                data-hero-rotate="{{ $page->backgroundCount }}"
                data-hero-next="{{ $heroNext }}"
                data-hero-src="{{ $page->backgroundImage('{n}') }}"
            @endif
        >
            <div class="hero-stage">
                <img class="hero-photo is-visible" src="{{ $heroPhoto }}" alt="">
                @if ($heroRotate)
                    <img class="hero-photo" src="{{ $page->backgroundImage($heroNext) }}" alt="" loading="lazy">
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
