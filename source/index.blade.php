---
heroImage: /assets/images/recipes/beef-kosha.jpg
pagination:
    collection: posts
---

@extends('_layouts.page')

@section('hero')
    @include('_partials.hero_home')
@endsection

@section('page-content-class', 'page-content--home')

@section('content-width', 'col-12')

@section('content')
    <div id="recipes" class="recipe-section-intro">
        <div>
            <p class="editorial-kicker">রেসিপি সংগ্রহ</p>
            <h2 class="recipe-section-title">আজ কী রান্না করবেন?</h2>
        </div>
        <p class="recipe-section-count">সহজ উপকরণ, পরিষ্কার নির্দেশনা, পরিচিত স্বাদ।</p>
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
