<button
    type="button"
    class="search-open-btn btn btn-link nav-link px-2"
    @click="openModal()"
    aria-label="{{ $page->t('search.label') }}"
    title="{{ $page->t('search.label') }} (/)"
>
    @include('_components.icon', ['name' => 'search', 'class' => 'icon--sm'])
    <span class="search-open-label d-none d-lg-inline ml-1">{{ $page->t('search.label') }}</span>
</button>
