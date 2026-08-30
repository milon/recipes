<!DOCTYPE html>
<html lang="{{ $page->locale }}" data-search-index="{{ $page->localePrefix() }}/index.json">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>{{ $page->localizedSiteName() }}{{ $page->title ? ' | ' . $page->title : '' }}</title>

        <link rel="icon" href="/favicon.ico" sizes="16x16 32x32 48x48">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @section('meta')
        <!-- Search Engine -->
        <meta name="description" content="{{ $page->description ?? $page->excerpt ?? $page->localizedSiteDescription() }}">
        <!-- Schema.org for Google -->
        <meta itemprop="name" content="{{ $page->localizedSiteName() }}{{ $page->title ? ' | ' . $page->title : '' }}">
        <meta itemprop="description" content="{{ $page->description ?? $page->excerpt ?? $page->localizedSiteDescription() }}">
        <!-- Twitter -->
        <meta name="twitter:site" content="@to_milon" />
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $page->localizedSiteName() }}{{ $page->title ? ' | ' . $page->title : '' }}">
        <meta name="twitter:description" content="{{ $page->description ?? $page->excerpt ?? $page->localizedSiteDescription() }}">
        <meta name="twitter:image" content="{{ $page->metaImage ?? $page->image ?? $page->randomBackground() }}" />
        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta property="og:url" content="{{ $page->getUrl() }}">
        <meta property="og:title" content="{{ $page->title ?  $page->title . ' | ' : '' }}{{ $page->localizedSiteName() }}">
        <meta property="og:description" content="{{ $page->description ?? $page->excerpt ?? $page->localizedSiteDescription() }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ $page->metaImage ?? $page->image ?? $page->randomBackground() }}" />
        <meta property="og:locale" content="{{ $page->locale === 'en' ? 'en_US' : 'bn_BD' }}">
        @if ($page->hasTranslation())
            <meta property="og:locale:alternate" content="{{ $page->locale === 'en' ? 'bn_BD' : 'en_US' }}">
        @endif
        @show

        <link rel="canonical" href="{{ $page->getUrl() }}">
        <link rel="alternate" hreflang="{{ $page->locale }}" href="{{ $page->getUrl() }}">
        @if ($page->hasTranslation())
            <link rel="alternate" hreflang="{{ $page->locale === 'en' ? 'bn' : 'en' }}" href="{{ rightTrimPath($page->baseUrl) }}{{ $page->alternateUrl() }}">
        @endif
        <link rel="alternate" hreflang="x-default" href="{{ $page->locale === 'en' ? rightTrimPath($page->baseUrl) . $page->alternateUrl() : $page->getUrl() }}">
        @php
            $preloadImage = $page->metaImage
                ?? $page->image
                ?? (($page->preloadHero ?? false) ? $page->heroBackground() : null);
            $preloadWebp = responsive_image_url($preloadImage, 'detail-1280');
            $preloadWebpSrcset = responsive_image_srcset($preloadImage);
        @endphp
        @if ($preloadImage)
            <link
                rel="preload"
                as="image"
                href="{{ $preloadWebp ?? $preloadImage }}"
                @if ($preloadWebp) type="image/webp" @endif
                @if ($preloadWebpSrcset)
                    imagesrcset="{{ $preloadWebpSrcset }}"
                    imagesizes="(min-width: 1200px) 1110px, calc(100vw - 30px)"
                @endif
                fetchpriority="high"
            >
        @endif
        <link rel="stylesheet" href="{{ vite_asset('css/main.css', 'assets/build') }}">
    </head>
    <body x-data="search()" @keydown.window.escape="closeModal()">
        <a class="skip-link" href="#main-content">{{ $page->t('common.skip_to_content') }}</a>
        @yield('body')
        @include('_components.search_modal')
        <script src="{{ vite_asset('js/main.js', 'assets/build') }}" type="module"></script>
    </body>
</html>
