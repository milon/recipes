<footer class="site-footer">
    <div class="container">
        <div class="site-footer-inner">
            <div class="site-footer-brand">
                <p class="editorial-kicker">রান্না হোক সহজ</p>
                <p class="site-footer-title">{{ $page->siteName }}</p>
                <p class="site-footer-description">{{ $page->siteDescription }}</p>
            </div>
            <div class="site-footer-meta">
                <ul class="site-footer-social list-inline" aria-label="সামাজিক যোগাযোগ">
                    @foreach ($page->socials as $social)
                        <li class="list-inline-item">
                            <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($social->icon) }}">
                                @include('_components.icon', ['name' => $social->icon, 'class' => 'icon--md'])
                            </a>
                        </li>
                    @endforeach
                </ul>
                <p class="copyright">
                    কপিরাইট &copy; {{ $page->siteName }}, {{ $page->translateNumber(date('Y')) }}
                </p>
            </div>
        </div>
    </div>
</footer>
