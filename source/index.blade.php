---
pagination:
    collection: posts
image: /assets/images/recipes/mixed-vegetables.jpg
---

@extends('_layouts.page')

@section('content-width', 'col-12')

@section('header-info')
    <p class="index-meta">মোট রেসিপির সংখ্যা: {{ $page->translateNumber($posts->count()) }}</p>
@endsection

@section('content')
    <div class="recipe-grid">
        @foreach ($pagination->items as $post)
            @include('_partials.recipe_card', ['post' => $post])
        @endforeach
    </div>

    <div class="clearfix recipe-pagination">
        @include('_partials.pagination')
    </div>
@endsection
