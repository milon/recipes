---
image: /assets/images/about-bg.jpg
title: সাইট সম্পর্কে
subtitle: আমি কেন এই ওয়েবসাইটটি তৈরি করলাম
alternateUrlPath: /en/about
---

@extends('_layouts.page')

@section('hero')
    @include('_partials.hero', [
        'heroKicker' => 'পরিচয়',
        'heroSummary' => [
            'রান্না শিখতে গিয়ে যে ঝামেলাগুলোয় পড়েছি, সেগুলো যেন আর কাউকে পোহাতে না হয় — এই সাইট সেই ছোট্ট চেষ্টা।',
        ],
        'heroFacts' => [
            ['icon' => 'users', 'label' => 'নুরুজ্জামান মিলন'],
            ['icon' => 'utensils', 'label' => $page->translateNumber($posts->count()) . 'টি রেসিপি'],
        ],
        'heroActions' => [
            ['label' => 'যোগাযোগ করুন', 'url' => '/contact'],
            ['label' => 'রেসিপি দেখুন', 'url' => '/', 'variant' => 'quiet'],
        ],
    ])
@endsection

@section('page-content-class', 'page-content--static')

@section('content-width', 'col-12')

@section('content')
    <div class="static-layout">
        <div class="static-main">
            <p class="editorial-kicker">গল্পটা যেভাবে শুরু</p>
            <h2 class="static-title">রান্নাঘরে ঢোকা এক সফটওয়্যার প্রকৌশলীর ডায়েরি</h2>

            <p>আমি নুরুজ্জামান মিলন, পেশায় একজন সফটয়্যার প্রকৌশলী। বর্তমান আবাস কানাডার ব্রিটিশ কলাম্বিয়া প্রভিন্সের ভ্যাঙ্কুভার শহরে।</p>

            <p>আমি নিজে কোন প্রফেশনাল শেফ নই। এমনকি ২০১৮ সালের আগে রান্নাঘরে কোনদিন যাইও নি। কিন্তু আমি খুব ভোজনরসিক মানুষ। বিদেশ-বিভূঁইয়ে এসে বাধ্য হয়েই রান্নার হাতেখড়ি, কারন পছন্দের দেশি খাবারগুলি খাবার একমাত্র উপায় হচ্ছে রান্না করে খাওয়া।</p>

            <p>আমি নিজে যেহেতু রান্না করতে অনেক ঝামেলার মুখোমুখি হয়েছি, তাই সবাই যেন খুব সহজেই রান্নাটা আয়ত্ব করতে পারে, সেজন্যই আমার এ ছোট্ট প্রয়াস। যে কোন মতামত জানালে খুব খুশি হবো। মতামত জানাতে এই ওয়েবসাইটের <a href="/contact">যোগাযোগ</a> লিঙ্কে থাকা ফরমটি ব্যবহার করতে পারেন।</p>

            <p>ধন্যবাদ।</p>
        </div>

        <aside class="static-aside">
            <div class="info-card">
                <p class="editorial-kicker">এক নজরে</p>
                <dl class="info-list">
                    <div>
                        <dt>লেখক</dt>
                        <dd>নুরুজ্জামান মিলন</dd>
                    </div>
                    <div>
                        <dt>পেশা</dt>
                        <dd>সফটওয়্যার প্রকৌশলী</dd>
                    </div>
                    <div>
                        <dt>অবস্থান</dt>
                        <dd>ভ্যাঙ্কুভার, কানাডা</dd>
                    </div>
                    <div>
                        <dt>রান্নার শুরু</dt>
                        <dd>{{ $page->translateNumber(2018) }} সাল</dd>
                    </div>
                </dl>

                <ul class="info-social" aria-label="সামাজিক যোগাযোগ">
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
        <p class="editorial-kicker">যা দিয়ে বানানো</p>
        <h2 class="static-section-title">ওয়েবসাইট তৈরিতে ব্যবহৃত টুলস</h2>

        <div class="tool-grid">
            <article class="tool-card">
                <h3>Jigsaw</h3>
                <p>পুরো সাইটটি তৈরি হয়েছে এই স্ট্যাটিক সাইট জেনারেটর দিয়ে।</p>
                <a href="https://jigsaw.tighten.co" target="_blank" rel="noopener noreferrer">jigsaw.tighten.co</a>
            </article>

            <article class="tool-card">
                <h3>Fuse.js</h3>
                <p>রেসিপি খোঁজার সার্চ ফাংশনালিটি চলে এই লাইব্রেরিতে।</p>
                <a href="https://fusejs.io" target="_blank" rel="noopener noreferrer">fusejs.io</a>
            </article>

            <article class="tool-card">
                <h3>Formspree</h3>
                <p>যোগাযোগ ফরমের বার্তাগুলো আমার কাছে পৌঁছায় এর মাধ্যমে।</p>
                <a href="https://formspree.io/" target="_blank" rel="noopener noreferrer">formspree.io</a>
            </article>

            <article class="tool-card">
                <h3>GitHub Pages ও Actions</h3>
                <p>সাইটটি হোস্ট করা আছে গিটহাব পেজেস-এ, ডেপ্লয়মেন্ট হয় গিটহাব একশনস দিয়ে।</p>
                <a href="https://github.com/milon/recipes" target="_blank" rel="noopener noreferrer">github.com/milon/recipes</a>
            </article>
        </div>
    </section>

    <section class="callout-card">
        <div class="callout-body">
            <p class="editorial-kicker">ডেভেলপারদের জন্য</p>
            <h2 class="callout-title">রেসিপিগুলো উন্মুক্ত API হিসেবেও আছে</h2>
            <p>এই ওয়েবসাইটের সবগুলো রেসিপি JSON API আকারে ব্যবহার করা যায়। API উন্মুক্ত করা হয়েছে <a href="https://creativecommons.org/licenses/by/2.0/deed.bn" target="_blank" rel="noopener noreferrer">Creative Commons অ্যাট্রিবিউশন ২.০ সাধারণ</a> লাইসেন্সের অধীনে।</p>
        </div>
        <a class="hero-action" href="/api/index.json" target="_blank" rel="noopener noreferrer">API দেখুন</a>
    </section>
@endsection
