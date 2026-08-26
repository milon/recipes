@extends('_layouts.page')

@section('hero')
    <header class="category-hero">
        <div class="container">
            <nav class="recipe-breadcrumb" aria-label="{{ $page->t('common.breadcrumb') }}">
                <a href="{{ $page->homeUrl() }}">← {{ $page->t('common.all_recipes') }}</a>
            </nav>
            <p class="editorial-kicker">{{ $page->t('category.kicker') }}</p>
            <h1 class="category-hero-title">{{ $page->category }}</h1>
            <p class="category-hero-count">
                {{ $page->t('category.count', ['count' => $page->translateNumber($page->categoryCount)]) }}
                @if ($pagination->totalPages > 1)
                    · {{ $page->t('category.page', [
                        'current' => $page->translateNumber($pagination->currentPage),
                        'total' => $page->translateNumber($pagination->totalPages),
                    ]) }}
                @endif
            </p>
        </div>
    </header>
@endsection

@section('page-content-class', 'page-content--home')

@section('content-width', 'col-12')

@section('content')
    <div class="recipe-grid">
        @foreach ($pagination->items as $post)
            @include('_partials.recipe_card', ['post' => $post])
        @endforeach
    </div>

    @if ($pagination->totalPages > 1)
        <div class="clearfix recipe-pagination">
            @include('_partials.pagination')
        </div>
    @endif
@endsection
