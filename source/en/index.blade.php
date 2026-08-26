---
locale: en
alternateUrlPath: /
pagination:
    collection: posts_en
---

@extends('_layouts.page')

@section('hero')
    @include('_partials.hero', [
        'heroRotate' => true,
        'heroKicker' => $page->t('home.kicker'),
        'heroTitle' => $page->localizedSiteName(),
        'heroSummary' => [
            $page->localizedSiteDescription(),
            $page->t('home.summary'),
        ],
        'heroFacts' => [
            ['icon' => 'utensils', 'label' => $page->t('home.recipe_count', [
                'count' => $page->translateNumber($posts_en->count()),
            ])],
        ],
    ])
@endsection

@section('page-content-class', 'page-content--home')

@section('content-width', 'col-12')

@section('content')
    <div id="recipes" class="recipe-section-intro">
        <p class="editorial-kicker">{{ $page->t('home.collection') }}</p>
        <h2 class="recipe-section-title">{{ $page->t('home.title') }}</h2>
        <p class="recipe-section-note">{{ $page->t('home.note') }}</p>
    </div>

    <div class="recipe-grid">
        @foreach ($pagination->items as $post)
            @include('_partials.recipe_card', ['post' => $post])
        @endforeach
    </div>

    <div class="clearfix recipe-pagination">
        @include('_partials.pagination')
    </div>
@endsection
