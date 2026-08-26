<nav id="paginator" aria-label="{{ $page->t('pagination.navigation') }}">
    @if ($previous = $pagination->previous)
        <a href="{{ $pagination->first }}" aria-label="{{ $page->t('pagination.first') }}">@include('_components.icon', ['name' => 'chevrons-left', 'class' => 'icon--sm'])</a>
        <a href="{{ $previous }}" aria-label="{{ $page->t('pagination.previous') }}">@include('_components.icon', ['name' => 'chevron-left', 'class' => 'icon--sm'])</a>
    @else
        <span>@include('_components.icon', ['name' => 'chevrons-left', 'class' => 'icon--sm'])</span>
        <span>@include('_components.icon', ['name' => 'chevron-left', 'class' => 'icon--sm'])</span>
    @endif

    @if ($pagination->currentPage <= ceil($page->paginatationLinkNumber / 2))
        @foreach ($pagination->pages as $pageNumber => $path)
            @if($pageNumber <= $page->paginatationLinkNumber)
                <a href="{{ $path }}"
                class="{{ $pagination->currentPage == $pageNumber ? 'selected' : '' }}"
                @if ($pagination->currentPage == $pageNumber) aria-current="page" @endif>
                    {{ $page->translateNumber($pageNumber) }}
                </a>
            @endif
        @endforeach
        @if($pagination->totalPages > $page->paginatationLinkNumber)
            <span>...</span>
        @endif
    @elseif ($pagination->currentPage >= ($pagination->totalPages - floor($page->paginatationLinkNumber / 2)))
        @if($pagination->totalPages > $page->paginatationLinkNumber)
            <span>...</span>
        @endif
        @foreach ($pagination->pages as $pageNumber => $path)
            @if($pageNumber > ($pagination->totalPages - $page->paginatationLinkNumber))
                <a href="{{ $path }}"
                class="{{ $pagination->currentPage == $pageNumber ? 'selected' : '' }}"
                @if ($pagination->currentPage == $pageNumber) aria-current="page" @endif>
                    {{ $page->translateNumber($pageNumber) }}
                </a>
            @endif
        @endforeach
    @else
        @if($pagination->totalPages > $page->paginatationLinkNumber)
            <span>...</span>
        @endif
        @foreach ($pagination->pages as $pageNumber => $path)
            @if($pageNumber >= ($pagination->currentPage - floor($page->paginatationLinkNumber / 2)) && $pageNumber <= ($pagination->currentPage + floor($page->paginatationLinkNumber / 2)))
                <a href="{{ $path }}"
                class="{{ $pagination->currentPage == $pageNumber ? 'selected' : '' }}"
                @if ($pagination->currentPage == $pageNumber) aria-current="page" @endif>
                    {{ $page->translateNumber($pageNumber) }}
                </a>
            @endif
        @endforeach
        @if($pagination->totalPages > $page->paginatationLinkNumber)
            <span>...</span>
        @endif
    @endif

    @if ($next = $pagination->next)
        <a href="{{ $next }}" aria-label="{{ $page->t('pagination.next') }}">@include('_components.icon', ['name' => 'chevron-right', 'class' => 'icon--sm'])</a>
        <a href="{{ $pagination->last }}" aria-label="{{ $page->t('pagination.last') }}">@include('_components.icon', ['name' => 'chevrons-right', 'class' => 'icon--sm'])</a>
    @else
        <span>@include('_components.icon', ['name' => 'chevron-right', 'class' => 'icon--sm'])</span>
        <span>@include('_components.icon', ['name' => 'chevrons-right', 'class' => 'icon--sm'])</span>
    @endif
</nav>
