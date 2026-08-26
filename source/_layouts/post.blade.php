@extends('_layouts.master')

@section('body')
    @include('_partials.navigation')

    @php
        $leadImage = $page->metaImage ?? ($page->image ? $page->image : $page->randomBackground());
        $recipe = recipe_card_content($__env->yieldContent('content'), $leadImage);
        $ingredients = recipe_figures($recipe['ingredients']);
        $steps = recipe_method_steps($recipe['method']);
        $servingsLabel = $page->formatServings();
        $prepTimeLabel = $page->formatPrepTime();
    @endphp

    <article class="recipe-detail">
        <main id="main-content" class="container recipe-detail-main">
            <nav class="recipe-breadcrumb" aria-label="{{ $page->t('common.breadcrumb') }}">
                <a href="{{ $page->homeUrl() }}">← {{ $page->t('common.all_recipes') }}</a>
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

                    <ul class="recipe-facts recipe-facts--stacked">
                        @if ($servingsLabel)
                            <li>
                                @include('_components.icon', ['name' => 'users', 'class' => 'recipe-fact-icon'])
                                {{ $servingsLabel }}
                            </li>
                        @endif

                        @if ($prepTimeLabel)
                            <li>
                                @include('_components.icon', ['name' => 'clock', 'class' => 'recipe-fact-icon'])
                                {{ $prepTimeLabel }}
                            </li>
                        @endif

                        <li>
                            @include('_components.icon', ['name' => 'calendar', 'class' => 'recipe-fact-icon'])
                            {{ $page->formatDate($page->date) }}
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
