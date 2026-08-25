@php
    $class = trim('icon ' . ($class ?? ''));
@endphp
@switch($name)
    @case('search')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
        </svg>
        @break
    @case('close')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
        </svg>
        @break
    @case('menu')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M4 6h16" />
            <path d="M4 12h16" />
            <path d="M4 18h16" />
        </svg>
        @break
    @case('chevron-left')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="m15 18-6-6 6-6" />
        </svg>
        @break
    @case('chevron-right')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="m9 18 6-6-6-6" />
        </svg>
        @break
    @case('chevrons-left')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="m11 17-5-5 5-5" />
            <path d="m18 17-5-5 5-5" />
        </svg>
        @break
    @case('chevrons-right')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="m6 17 5-5-5-5" />
            <path d="m13 17 5-5-5-5" />
        </svg>
        @break
    @case('utensils')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M3 2v7c0 1.1.9 2 2 2h0a2 2 0 0 0 2-2V2" />
            <path d="M7 2v20" />
            <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7" />
        </svg>
        @break
    @case('rss')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M4 11a9 9 0 0 1 9 9" />
            <path d="M4 4a16 16 0 0 1 16 16" />
            <circle cx="5" cy="19" r="1" fill="currentColor" stroke="none" />
        </svg>
        @break
    @case('twitter')
    @case('x')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" fill="currentColor" fill-rule="evenodd" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M818 800 498.11 333.745l.546.437L787.084 0h-96.385L455.738 272 269.15 0H16.367l298.648 435.31-.036-.037L0 800h96.385l261.222-302.618L565.217 800zM230.96 72.727l448.827 654.546h-76.38L154.217 72.727z" transform="translate(103 112)" />
        </svg>
        @break
    @case('facebook')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
        </svg>
        @break
    @case('linkedin')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z" />
            <rect x="2" y="9" width="4" height="12" />
            <circle cx="4" cy="4" r="2" />
        </svg>
        @break
@endswitch
