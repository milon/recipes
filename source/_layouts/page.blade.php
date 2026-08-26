@extends('_layouts.master')

@section('body')
    <!-- Navigation -->
    @include('_partials.navigation')

    @hasSection('hero')
        @yield('hero')
    @else
        <header class="page-hero">
            <div class="container page-hero-grid">
                <div class="page-hero-copy">
                    <p class="editorial-kicker">{{ $page->siteName }}</p>
                    <h1>{{ $page->title ? $page->title : $page->siteName }}</h1>
                    <p class="page-hero-subtitle">{{ $page->subtitle ? $page->subtitle : $page->siteDescription }}</p>
                    @yield('header-info')
                </div>
                <div
                    class="page-hero-image"
                    role="img"
                    aria-label="{{ $page->title ? $page->title : $page->siteName }}"
                    style="background-image: url({{ $page->image ? $page->image : $page->randomBackground() }})"
                ></div>
            </div>
        </header>
    @endif

    <!-- Main Content -->
    <main id="main-content" class="container page-content @yield('page-content-class')">
        <div class="row">
            <div class="@yield('content-width', 'col-lg-8 col-md-10 mx-auto')">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('_partials/footer')
@endsection
