---
pagination:
    collection: posts
---

@extends('_layouts.page')

@section('hero')
    @include('_partials.hero', [
        'heroRotate' => true,
        'heroKicker' => 'সহজ রান্না · ঘরের স্বাদ',
        'heroTitle' => $page->siteName,
        'heroSummary' => [
            $page->siteDescription,
            'প্রতিটি রেসিপিতে পরিমাণসহ উপকরণের তালিকা আর ধাপে ধাপে রান্নার নির্দেশনা দেয়া আছে, সবই ঘরের চেনা উপকরণে।',
        ],
        'heroFacts' => [
            ['icon' => 'utensils', 'label' => $page->translateNumber($posts->count()) . 'টি বাংলা রেসিপি'],
        ],
    ])
@endsection

@section('page-content-class', 'page-content--home')

@section('content-width', 'col-12')

@section('content')
    <div id="recipes" class="recipe-section-intro">
        <p class="editorial-kicker">রেসিপি সংগ্রহ</p>
        <h2 class="recipe-section-title">আজ কী রান্না করবেন?</h2>
        <p class="recipe-section-note">সহজ উপকরণ, পরিষ্কার নির্দেশনা, পরিচিত স্বাদ।</p>
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
