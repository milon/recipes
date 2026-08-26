---
locale: en
alternateUrlPath: /contact
image: /assets/images/contact-bg.jpg
title: Contact
subtitle: If you have a question, feel free to write
---

@extends('_layouts.page')

@section('hero')
    @include('_partials.hero', [
        'heroKicker' => 'Get in touch',
        'heroSummary' => [
            'Send a recipe question, feedback, or a request for a dish you would like to see.',
        ],
        'heroFacts' => [
            ['icon' => 'clock', 'label' => 'I usually reply within a few days'],
        ],
    ])
@endsection

@section('page-content-class', 'page-content--static')
@section('content-width', 'col-12')

@section('content')
    <div class="static-layout">
        <div class="static-main">
            <div class="form-card">
                <p class="editorial-kicker">Send a message</p>
                <h2 class="form-card-title">Tell me what is on your mind</h2>

                <form class="contact-form" method="POST" action="{{ $page->contactFormUrl }}">
                    <div class="contact-field">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your name" required>
                    </div>

                    <div class="contact-field">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" placeholder="Your email address" required>
                    </div>

                    <div class="contact-field contact-field--wide">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Write your message" required></textarea>
                    </div>

                    <input type="text" name="_gotcha" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

                    <div class="contact-actions">
                        <button type="submit" class="btn btn-primary">Send message</button>
                        <p class="contact-note">Your email address will only be used to reply to you.</p>
                    </div>
                </form>
            </div>
        </div>

        <aside class="static-aside">
            <div class="info-card">
                <p class="editorial-kicker">Things you can ask about</p>
                <ul class="info-points">
                    <li>A recipe step that is unclear</li>
                    <li>An easy substitute for an ingredient</li>
                    <li>A dish you would like to see on the site</li>
                    <li>An error you noticed</li>
                </ul>

                <p class="info-note">I am not a professional chef, but I will do my best to answer any question you have. Please feel free to ask.</p>

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
@endsection
