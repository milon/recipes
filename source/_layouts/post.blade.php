@extends('_layouts.master')

@section('body')
    @include('_partials.navigation')

    <article class="recipe-detail">
        <header
            class="recipe-detail-hero"
            style="background-image: url({{ $page->metaImage ?? ($page->image ? $page->image : $page->randomBackground()) }})"
        >
            <div class="recipe-detail-hero-scrim" aria-hidden="true"></div>
            <div class="container recipe-detail-hero-content">
                <nav class="recipe-breadcrumb recipe-breadcrumb--hero" aria-label="Breadcrumb">
                    <a href="/">← সব রেসিপি</a>
                </nav>

                @if (!empty($page->categories))
                    <div class="recipe-detail-tags">
                        @foreach ($page->categories as $category)
                            <span class="recipe-tag recipe-tag--hero">{{ $category }}</span>
                        @endforeach
                    </div>
                @endif

                <h1 class="recipe-detail-title">{{ $page->title }}</h1>

                @if ($page->subtitle ?? null)
                    <p class="recipe-detail-subtitle">{{ $page->subtitle }}</p>
                @endif

                <p class="recipe-detail-meta">
                    পোস্ট করা হয়েছে · {{ $page->banglaDate($page->date) }}
                </p>
            </div>
        </header>

        <div class="container recipe-detail-main">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="recipe-detail-content">
                        @yield('content')
                    </div>

                    <div class="recipe-detail-footer">
                        @include('_partials/share')
                        @include('_partials/post_pagination')
                    </div>
                </div>
            </div>
        </div>
    </article>

    @include('_partials/footer')
@endsection
