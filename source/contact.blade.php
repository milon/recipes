---
image: /assets/images/contact-bg.jpg
title: যোগাযোগ
subtitle: আপনার যদি কোন প্রশ্ন থাকে, স্বাচ্ছন্দে লিখুন
---

@extends('_layouts.page')

@section('hero')
    @include('_partials.hero', [
        'heroKicker' => 'কথা বলুন',
        'heroSummary' => [
            'রেসিপি নিয়ে প্রশ্ন, মতামত কিংবা নতুন রান্নার অনুরোধ — যা খুশি লিখে পাঠান।',
        ],
        'heroFacts' => [
            ['icon' => 'clock', 'label' => 'সাধারণত কয়েক দিনের মধ্যেই উত্তর দিই'],
        ],
    ])
@endsection

@section('page-content-class', 'page-content--static')

@section('content-width', 'col-12')

@section('content')
    <div class="static-layout">
        <div class="static-main">
            <div class="form-card">
                <p class="editorial-kicker">বার্তা পাঠান</p>
                <h2 class="form-card-title">আপনার কথাটা লিখুন</h2>

                <form class="contact-form" method="POST" action="{{ $page->contactFormUrl }}">
                    <div class="contact-field">
                        <label for="name">নাম</label>
                        <input type="text" id="name" name="name" placeholder="আপনার নাম" required>
                    </div>

                    <div class="contact-field">
                        <label for="email">ইমেইল ঠিকানা</label>
                        <input type="email" id="email" name="email" placeholder="ইমেইল এড্রেস" required>
                    </div>

                    <div class="contact-field contact-field--wide">
                        <label for="message">ম্যাসেজ</label>
                        <textarea id="message" name="message" rows="6" placeholder="আপনার ম্যাসেজ লিখুন" required></textarea>
                    </div>

                    <input type="text" name="_gotcha" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

                    <div class="contact-actions">
                        <button type="submit" class="btn btn-primary">পাঠিয়ে দিন</button>
                        <p class="contact-note">আপনার ইমেইল ঠিকানা শুধু উত্তর দেয়ার জন্যই ব্যবহার করা হবে।</p>
                    </div>
                </form>
            </div>
        </div>

        <aside class="static-aside">
            <div class="info-card">
                <p class="editorial-kicker">যা নিয়ে লিখতে পারেন</p>
                <ul class="info-points">
                    <li>রেসিপির কোন ধাপ বুঝতে অসুবিধা হচ্ছে</li>
                    <li>কোন উপকরণের সহজ বিকল্প খুঁজছেন</li>
                    <li>নতুন কোন রান্না সাইটে দেখতে চান</li>
                    <li>কোথাও ভুল চোখে পড়েছে</li>
                </ul>

                <p class="info-note">আমি নিজে কোন প্রফেশনাল শেফ নই, তবুও আপনার মনের যেকোন প্রশ্নের উত্তর দেয়ার সর্বাত্মক চেষ্টা করবো। স্বাচ্ছন্দে প্রশ্ন করুন।</p>

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
@endsection
