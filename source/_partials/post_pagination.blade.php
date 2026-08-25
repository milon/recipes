<nav class="recipe-nav-links" aria-label="অন্যান্য রেসিপি">
    @if ($page->getPrevious())
        <a href="{{ $page->getPrevious()->getPath('web') }}" class="recipe-nav-link recipe-nav-link--prev">
            <span class="recipe-nav-link-label">আগের রেসিপি</span>
            <span class="recipe-nav-link-title">
                @include('_components.icon', ['name' => 'chevron-left', 'class' => 'icon--sm'])
                {{ $page->getPrevious()->title }}
            </span>
        </a>
    @endif
    @if ($page->getNext())
        <a href="{{ $page->getNext()->getPath('web') }}" class="recipe-nav-link recipe-nav-link--next">
            <span class="recipe-nav-link-label">পরের রেসিপি</span>
            <span class="recipe-nav-link-title">
                {{ $page->getNext()->title }}
                @include('_components.icon', ['name' => 'chevron-right', 'class' => 'icon--sm'])
            </span>
        </a>
    @endif
</nav>
