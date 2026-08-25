<footer class="site-footer">
    <div class="container">
        <div class="site-footer-inner">
            <ul class="site-footer-social list-inline">
                @foreach ($page->socials as $social)
                    <li class="list-inline-item">
                        <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($social->icon) }}">
                            @include('_components.icon', ['name' => $social->icon, 'class' => 'icon--md'])
                        </a>
                    </li>
                @endforeach
            </ul>
            <p class="copyright text-muted">
                কপিরাইট &copy; {{ $page->siteName }}, {{ $page->translateNumber(date('Y')) }}
            </p>
        </div>
    </div>
</footer>
