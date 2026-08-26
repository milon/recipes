<section class="hero-home">
    <div class="container hero-home-grid">
        <div class="hero-home-copy">
            <p class="editorial-kicker">সহজ রান্না · ঘরের স্বাদ</p>
            <h1 class="hero-home-title">{{ $page->siteName }}</h1>
            <p class="hero-home-summary">
                {{ $page->siteDescription }}
                পরিচিত উপকরণে সহজভাবে রান্না করার জন্য সাজানো
                {{ $page->translateNumber($posts->count()) }}টি বাংলা রেসিপি।
            </p>
            <a href="#recipes" class="hero-home-cta">
                সব রেসিপি দেখুন
                @include('_components.icon', ['name' => 'chevron-right', 'class' => 'icon--sm'])
            </a>
        </div>
        <div class="hero-home-visual">
            <div
                class="hero-home-image"
                role="img"
                aria-label="সাজানো খাবার"
                style="background-image: url({{ $page->heroImage ?? $page->randomBackground() }})"
            ></div>
            <div class="hero-home-note" aria-hidden="true">
                <span>রেসিপি</span>
                <strong>{{ $page->translateNumber($posts->count()) }}</strong>
            </div>
        </div>
    </div>
</section>
