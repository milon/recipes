<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ $page->homeUrl() }}" aria-label="{{ $page->localizedSiteName() }} — {{ $page->t('nav.home') }}">
            <span class="navbar-brand-mark">
                @include('_components.icon', ['name' => 'logo', 'class' => 'icon--md'])
            </span>
            <span>{{ $page->localizedSiteName() }}</span>
        </a>

        <div class="navbar-mobile-tools d-flex d-lg-none align-items-center ml-auto">
            @include('_components.language_switch')
            @include('_components.search_trigger')
            <button class="navbar-toggler" type="button" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="{{ $page->t('nav.open_menu') }}">
                <span>{{ $page->t('nav.menu') }}</span>
                @include('_components.icon', ['name' => 'menu', 'class' => 'icon--sm'])
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ $page->homeUrl() }}">{{ $page->t('nav.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $page->localePrefix() }}/about">{{ $page->t('nav.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $page->localePrefix() }}/contact">{{ $page->t('nav.contact') }}</a>
                </li>
                <li class="nav-item d-none d-lg-flex align-items-center">
                    @include('_components.language_switch')
                </li>
                <li class="nav-item d-none d-lg-flex align-items-center">
                    @include('_components.search_trigger')
                </li>
            </ul>
        </div>
    </div>
</nav>
