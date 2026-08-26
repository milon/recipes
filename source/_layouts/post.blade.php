@extends('_layouts.master')

@section('body')
    @include('_partials.navigation')

    @php
        $leadImage = $page->metaImage ?? ($page->image ? $page->image : $page->randomBackground());
        $recipe = recipe_card_content($__env->yieldContent('content'), $leadImage);
        $ingredients = recipe_figures($recipe['ingredients']);
        $steps = recipe_method_steps($recipe['method'], fn ($number) => $page->translateNumber($number));
        $servingsLabel = $page->formatServings();
        $prepTimeLabel = $page->formatPrepTime();
    @endphp

    <article class="recipe-detail">
        <main id="main-content" class="container recipe-detail-main">
            <nav class="recipe-breadcrumb" aria-label="ব্রেডক্রাম্ব">
                <a href="/">← সব রেসিপি</a>
            </nav>

            <div class="recipe-card-sheet">
                <header class="recipe-card-header">
                    <div class="recipe-card-heading">
                        <h1 class="recipe-card-title">{{ $page->title }}</h1>

                        <div class="recipe-card-lead">
                            @if ($recipe['intro'])
                                {!! $recipe['intro'] !!}
                            @elseif ($page->subtitle ?? null)
                                <p>{{ $page->subtitle }}</p>
                            @endif
                        </div>

                        @include('_partials.category_tags', ['wrapperClass' => 'recipe-card-header-tags'])
                    </div>

                    <ul class="recipe-card-facts">
                        @if ($servingsLabel)
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="recipe-card-fact-icon" aria-hidden="true">
                                    <path d="M4 3v7a2 2 0 0 0 4 0V3M6 12v9" />
                                    <path d="M16 3c-1.5 1.5-2 3-2 5s.5 3 2 3 2-1 2-3-.5-3.5-2-5zM16 11v10" />
                                </svg>
                                {{ $servingsLabel }}
                            </li>
                        @endif

                        @if ($prepTimeLabel)
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="recipe-card-fact-icon" aria-hidden="true">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3.5 2" />
                                </svg>
                                {{ $prepTimeLabel }}
                            </li>
                        @endif

                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="recipe-card-fact-icon" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="16" rx="2" />
                                <path d="M3 10h18M8 3v4M16 3v4" />
                            </svg>
                            {{ $page->banglaDate($page->date) }}
                        </li>
                    </ul>
                </header>

                <figure class="recipe-card-photo">
                    <img src="{{ $leadImage }}" alt="{{ $page->title }}">
                </figure>

                @if ($ingredients || $steps)
                    <div class="recipe-card-columns">
                        @if ($ingredients)
                            <section class="recipe-card-ingredients" aria-labelledby="recipe-ingredients-heading">
                                <h2 id="recipe-ingredients-heading" class="recipe-card-label">{{ $recipe['ingredientsTitle'] }}</h2>
                                {!! $ingredients !!}
                            </section>
                        @endif

                        @if ($steps)
                            <section class="recipe-card-method" aria-labelledby="recipe-method-heading">
                                <h2 id="recipe-method-heading" class="recipe-card-label">{{ $recipe['methodTitle'] }}</h2>
                                {!! $steps !!}
                            </section>
                        @endif
                    </div>
                @else
                    <div class="recipe-card-body">
                        @yield('content')
                    </div>
                @endif

                @if ($recipe['extra'])
                    <div class="recipe-card-body">
                        {!! recipe_figures($recipe['extra']) !!}
                    </div>
                @endif

                <div class="recipe-card-footer">
                    @include('_partials.share')
                    @include('_partials.post_pagination')
                </div>
            </div>
        </main>
    </article>

    @include('_partials.footer')
@endsection
