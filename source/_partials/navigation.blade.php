<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/">{{ $page->siteName }}</a>

        <div class="navbar-mobile-tools d-flex d-lg-none align-items-center ml-auto">
            @include('_components.search_trigger')
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                মেনু &nbsp;
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="/">হোম</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">সাইট সম্পর্কে</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">যোগাযোগ</a>
                </li>
                <li class="nav-item d-none d-lg-flex align-items-center">
                    @include('_components.search_trigger')
                </li>
            </ul>
        </div>
    </div>
</nav>
