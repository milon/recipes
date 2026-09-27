<button
    type="button"
    class="theme-switch"
    aria-pressed="false"
    data-label-dark="{{ $page->t('nav.theme_dark') }}"
    data-label-light="{{ $page->t('nav.theme_light') }}"
    aria-label="{{ $page->t('nav.theme_dark') }}"
>
    @include('_components.icon', ['name' => 'moon', 'class' => 'icon--sm theme-switch-icon theme-switch-icon--moon'])
    @include('_components.icon', ['name' => 'sun', 'class' => 'icon--sm theme-switch-icon theme-switch-icon--sun'])
</button>
