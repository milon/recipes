<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/">{{ $page->siteName }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            মেনু &nbsp;
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div id="vue-search">
                <search></search>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">হোম</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">সাইট সম্পর্কে</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">যোগাযোগ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
