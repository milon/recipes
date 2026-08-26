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
    @case('logo')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M2.5 12.5h19" />
            <path d="M4.5 12.5a7.5 7.5 0 0 0 15 0" />
            <path d="M9.2 9.8c0-1.3 1.3-1.8 1.3-3.1S9.2 4.4 9.2 3.1" />
            <path d="M14.8 9.8c0-1.3-1.3-1.8-1.3-3.1S14.8 4.4 14.8 3.1" />
        </svg>
        @break
    @case('utensils')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M3 2v7c0 1.1.9 2 2 2h0a2 2 0 0 0 2-2V2" />
            <path d="M7 2v20" />
            <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7" />
        </svg>
        @break
    @case('users')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>
        @break
    @case('clock')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <circle cx="12" cy="12" r="9" />
            <path d="M12 7v5l3.5 2" />
        </svg>
        @break
    @case('calendar')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <rect x="3" y="5" width="18" height="16" rx="2" />
            <path d="M3 10h18M8 3v4M16 3v4" />
        </svg>
        @break
    @case('language')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 143 150" fill="currentColor" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <g transform="translate(0 150) scale(0.1 -0.1)">
                <path d="M1220 1493c0-5-13-23-28-41l-28-33-54 27c-81 41-188 45-262 12-50-23-128-82-128-97 0-3 35-6 78-6 85-1 125-17 196-78l40-34-39-47-39-48 35 6c19 3 88 13 154 22 66 9 122 18 124 20 8 7-32 304-40 304-5 0-9-3-9-7z"/>
                <path d="M110 1234c-45-20-68-41-91-86-17-33-19-61-19-253 0-195 2-220 20-254 23-46 57-75 106-91l34-12 0-77c0-83 14-111 56-111 11 0 73 43 139 95l120 95 71 0c70 0 72-1 77-28 8-40 45-82 91-103 33-15 66-19 173-19l133 0 101-75c55-41 104-75 108-75 19 0 33 33 38 89 6 60 6 61 40 67 19 4 48 18 64 31 56 47 59 63 59 285 0 231-5 250-79 288-37 18-59 20-251 20l-210 0 0 38c-1 75-50 146-122 177-54 22-606 22-658-1z m676-86 34-38 0-218c0-219 0-219-25-246-37-40-65-46-212-46l-135 0-47-38c-25-21-77-62-115-92l-68-54 7 92 7 92-38 0c-51 0-83 18-111 59-22 33-23 42-23 235 0 184 2 204 20 234 36 59 53 62 378 59l294-2 34-37z m320-273c9-14 27-54 39-88 13-34 35-92 49-129l25-68-40 0c-36 0-41 3-51 30-10 30-12 31-61 28-45-3-52-6-57-28-5-21-12-25-48-28l-42-3 14 38c57 157 86 235 96 253 15 29 56 26 76-5z"/>
                <path d="M550 1033c0-17-13-18-161-15l-161 4 4-29 3-28 85-3 85-3-69-29c-38-16-74-34-79-39-18-18 2-60 31-67 38-9 109-51 116-69 3-9 18-15 41-15l35 0 0 110c0 108 0 110 23 110 40 0 47-18 47-122l0-98 30 0 30 0 0 110c0 103 1 110 20 110 16 0 20 7 20 30 0 23-4 30-20 30-11 0-23 7-26 15-9 22-54 20-54-2z m-140-174 0-40-26 20c-15 12-34 21-43 22-12 0 51 37 67 39 1 0 2-18 2-41z"/>
                <path d="M1051 769c-7-23-15-47-18-55-4-10 4-14 31-14 20 0 36 4 36 10 0 20-24 100-30 100-4 0-12-18-19-41z"/>
                <path d="M424 340c-67-20-126-40-131-43-8-5 44-209 73-287 3-9 14 0 31 30 14 25 27 46 29 48 1 2 24-4 51-13 77-27 172-23 237 9 47 23 164 131 153 142-1 2-25-4-52-12-64-20-133-12-201 21-76 37-82 47-56 101 27 55 29 55-134 4z"/>
            </g>
        </svg>
        @break
    @case('tag')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ $class }}" @if(empty($label)) aria-hidden="true" @endif @if(!empty($label)) role="img" aria-label="{{ $label }}" @endif>
            <path d="M20.6 13.4 12 22l-9-9 8.6-8.6a2 2 0 0 1 1.4-.6H20a2 2 0 0 1 2 2v6.2a2 2 0 0 1-.6 1.4Z" />
            <circle cx="16.5" cy="7.5" r="1.5" />
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
