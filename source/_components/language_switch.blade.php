<a
    class="lang-switch{{ isset($class) ? ' ' . $class : '' }}"
    href="{{ $page->alternateUrl() }}"
    hreflang="{{ $page->locale === 'bn' ? 'en' : 'bn' }}"
    aria-label="{{ $page->t('nav.switch_language') }}"
    title="{{ $page->t('nav.switch_language') }}"
>
    @include('_components.icon', ['name' => 'language', 'class' => 'icon--sm'])
    <span class="lang-switch-code">{{ $page->locale === 'bn' ? 'বাংলা' : 'Eng' }}</span>
</a>
