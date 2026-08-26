---
locale: en
alternateUrlPath: /about
image: /assets/images/about-bg.jpg
title: About
subtitle: Why I created this website
---

@extends('_layouts.page')

@section('hero')
    @include('_partials.hero', [
        'heroKicker' => 'Introduction',
        'heroSummary' => [
            'This site is my small attempt to help others avoid the difficulties I faced while learning to cook.',
        ],
        'heroFacts' => [
            ['icon' => 'users', 'label' => 'Nuruzzaman Milon'],
            ['icon' => 'utensils', 'label' => $page->t('category.count', ['count' => $posts_en->count()])],
        ],
        'heroActions' => [
            ['label' => 'Contact me', 'url' => '/en/contact'],
            ['label' => 'Browse recipes', 'url' => '/en', 'variant' => 'quiet'],
        ],
    ])
@endsection

@section('page-content-class', 'page-content--static')
@section('content-width', 'col-12')

@section('content')
    <div class="static-layout">
        <div class="static-main">
            <p class="editorial-kicker">How it began</p>
            <h2 class="static-title">A software engineer's diary from the kitchen</h2>

            <p>I am Nuruzzaman Milon, a software engineer living in Vancouver, British Columbia, Canada.</p>

            <p>I am not a professional chef. In fact, I had never even stepped into a kitchen before 2018. I do, however, love food. Living abroad forced me to learn because cooking was the only way to enjoy many of my favorite dishes from home.</p>

            <p>I faced plenty of challenges while learning, so this site is my attempt to make cooking easier for everyone. I would be delighted to hear your feedback. You can send it through the form on the <a href="/en/contact">contact page</a>.</p>

            <p>Thank you.</p>
        </div>

        <aside class="static-aside">
            <div class="info-card">
                <p class="editorial-kicker">At a glance</p>
                <dl class="info-list">
                    <div>
                        <dt>Author</dt>
                        <dd>Nuruzzaman Milon</dd>
                    </div>
                    <div>
                        <dt>Profession</dt>
                        <dd>Software engineer</dd>
                    </div>
                    <div>
                        <dt>Location</dt>
                        <dd>Vancouver, Canada</dd>
                    </div>
                    <div>
                        <dt>Started cooking</dt>
                        <dd>2018</dd>
                    </div>
                </dl>

                <ul class="info-social" aria-label="{{ $page->t('common.social_links') }}">
                    @foreach ($page->socials as $social)
                        <li>
                            <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($social->icon) }}">
                                @include('_components.icon', ['name' => $social->icon, 'class' => 'icon--md'])
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>

    <section class="static-section">
        <p class="editorial-kicker">Built with</p>
        <h2 class="static-section-title">Tools used to build this website</h2>

        <div class="tool-grid">
            <article class="tool-card">
                <h3>Jigsaw</h3>
                <p>The static site generator used to build the entire site.</p>
                <a href="https://jigsaw.tighten.co" target="_blank" rel="noopener noreferrer">jigsaw.tighten.co</a>
            </article>

            <article class="tool-card">
                <h3>Fuse.js</h3>
                <p>The library powering recipe search.</p>
                <a href="https://fusejs.io" target="_blank" rel="noopener noreferrer">fusejs.io</a>
            </article>

            <article class="tool-card">
                <h3>Formspree</h3>
                <p>The service that delivers contact form messages.</p>
                <a href="https://formspree.io/" target="_blank" rel="noopener noreferrer">formspree.io</a>
            </article>

            <article class="tool-card">
                <h3>GitHub Pages and Actions</h3>
                <p>The site is hosted on GitHub Pages and deployed with GitHub Actions.</p>
                <a href="https://github.com/milon/recipes" target="_blank" rel="noopener noreferrer">github.com/milon/recipes</a>
            </article>
        </div>
    </section>

    <section class="callout-card">
        <div class="callout-body">
            <p class="editorial-kicker">For developers</p>
            <h2 class="callout-title">Recipes are also available through an open API</h2>
            <p>Every translated recipe is available as JSON under the <a href="https://creativecommons.org/licenses/by/2.0/deed.en" target="_blank" rel="noopener noreferrer">Creative Commons Attribution 2.0 Generic</a> license.</p>
        </div>
        <a class="hero-action" href="/en/api/index.json" target="_blank" rel="noopener noreferrer">View API</a>
    </section>
@endsection
