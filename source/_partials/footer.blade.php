<footer class="site-footer">
    <div class="container">
        <div class="site-footer-inner">
            <div class="site-footer-brand">
                <p class="editorial-kicker">{{ $page->t('footer.kicker') }}</p>
                <p class="site-footer-title">{{ $page->localizedSiteName() }}</p>
                <p class="site-footer-description">{{ $page->localizedSiteDescription() }}</p>
            </div>
            <div class="site-footer-meta">
                <ul class="site-footer-social list-inline" aria-label="{{ $page->t('common.social_links') }}">
                    @foreach ($page->socials as $social)
                        <li class="list-inline-item">
                            <a href="{{ $social->icon === 'rss' ? $page->localePrefix() . '/feed.xml' : $social->link }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($social->icon) }}">
                                @include('_components.icon', ['name' => $social->icon, 'class' => 'icon--md'])
                            </a>
                        </li>
                    @endforeach
                </ul>
                <p class="copyright">
                    {{ $page->t('footer.copyright', [
                        'site' => $page->localizedSiteName(),
                        'year' => $page->translateNumber(date('Y')),
                    ]) }}
                </p>
            </div>
        </div>
    </div>
</footer>
