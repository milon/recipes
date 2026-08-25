<section class="hero-home">
    <div class="hero-home-bg" aria-hidden="true"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-home-copy">
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
            <div class="col-lg-6 hero-home-visual">
                <div class="hero-home-image-frame">
                    <img
                        src="{{ $page->heroImage ?? '/assets/images/recipes/beef-kosha.jpg' }}"
                        alt="সহজ রেসিপি — ঘরোয়া খাবার"
                        loading="eager"
                    >
                </div>
            </div>
        </div>
    </div>
</section>
