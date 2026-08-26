@php
    $sharePageUrl = $page->getUrl();
@endphp

<div class="recipe-share">
    <span class="recipe-share-label">{{ $page->t('recipe.share') }}</span>
    <div class="recipe-share-links">
        <button
            type="button"
            class="recipe-share-btn recipe-share-btn--x"
            data-share="x"
            data-url="{{ $sharePageUrl }}"
            aria-label="X"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" fill="currentColor" fill-rule="evenodd" class="recipe-share-icon" aria-hidden="true">
                <path d="M818 800 498.11 333.745l.546.437L787.084 0h-96.385L455.738 272 269.15 0H16.367l298.648 435.31-.036-.037L0 800h96.385l261.222-302.618L565.217 800zM230.96 72.727l448.827 654.546h-76.38L154.217 72.727z" transform="translate(103 112)" />
            </svg>
        </button>
        <button
            type="button"
            class="recipe-share-btn recipe-share-btn--fb"
            data-share="fb"
            data-url="{{ $sharePageUrl }}"
            aria-label="Facebook"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="recipe-share-icon" aria-hidden="true">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
            </svg>
        </button>
        <button
            type="button"
            class="recipe-share-btn recipe-share-btn--in"
            data-share="in"
            data-url="{{ $sharePageUrl }}"
            aria-label="LinkedIn"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="recipe-share-icon" aria-hidden="true">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z" />
                <rect x="2" y="9" width="4" height="12" />
                <circle cx="4" cy="4" r="2" />
            </svg>
        </button>
    </div>
</div>
