---
pagination:
    collection: posts
---

@extends('_layouts.page')

@section('header-info')
    <p class="index-meta">মোট রেসিপির সংখ্যা: {{ $page->translateNumber($posts->count()) }}</p>
@endsection

@section('content')
    @foreach ($pagination->items as $post)
        <div class="post-preview">
            <a href="{{ $post->getPath('web') }}">
                <h2 class="post-title">
                    {{ $post->title }}
                </h2>
                <h4 class="post-subtitle">
                    {{ $post->excerpt ?? "" }}
                </h4>
            </a>
            <p class="post-meta">
                পোস্ট করা হয়েছে - {{ $page->banglaDate($post->date) }}
            </p>
        </div>
        <hr>
    @endforeach

    <!-- Pager -->
    <div class="clearfix">
        @include('_partials.pagination')
    </div>
@endsection
