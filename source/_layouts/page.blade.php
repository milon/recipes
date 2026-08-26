@extends('_layouts.master')

@section('body')
    <!-- Navigation -->
    @include('_partials.navigation')

    @hasSection('hero')
        @yield('hero')
    @else
        @include('_partials.hero')
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
