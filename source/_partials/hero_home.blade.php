<section
    class="hero-home"
    style="background-image: url({{ $page->randomBackground() }})"
>
    <div class="hero-home-scrim" aria-hidden="true"></div>
    <div class="container hero-home-content">
        <p class="hero-home-eyebrow">{{ $page->siteName }}</p>
        <h1 class="hero-home-title">{{ $page->siteDescription }}</h1>
        <p class="hero-home-meta">
            <span class="hero-home-badge">মোট {{ $page->translateNumber($posts->count()) }}টি রেসিপি</span>
        </p>
        <a href="#recipes" class="btn hero-home-cta">
            @include('_components.icon', ['name' => 'utensils', 'class' => 'icon--sm mr-2'])
            রেসিপি দেখুন
        </a>
    </div>
</section>
