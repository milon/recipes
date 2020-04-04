<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto d-flex justify-content-center">
                <ul class="list-inline d-flex justify-content-center">
                    @foreach($page->socials as $social)
                        <li class="list-inline-item">
                            <a href="{{ $social->link }}" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="{{ $social->icon }} fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-8 col-md-10 mx-auto">
                <p class="copyright text-muted">
                    কপিরাইট &copy; {{ $page->siteName }}, {{ $page->translateNumber(date('Y')) }}
                </p>
            </div>
        </div>
    </div>
</footer>
