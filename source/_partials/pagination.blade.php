<section id="paginator">
    @if ($previous = $pagination->previous)
        <a href="{{ $pagination->first }}"><i class="fas fa-angle-double-left"></i></a>
        <a href="{{ $previous }}"><i class="fas fa-angle-left"></i></a>
    @else
        <span><i class="fas fa-angle-double-left"></i></span>
        <span><i class="fas fa-angle-left"></i></span>
    @endif

    @if ($pagination->currentPage <= 3)
        @foreach ($pagination->pages as $pageNumber => $path)
            @if($pageNumber <= 5)
                <a href="{{ $path }}"
                class="{{ $pagination->currentPage == $pageNumber ? 'selected' : '' }}">
                    {{ $page->translateNumber($pageNumber) }}
                </a>
            @endif
        @endforeach
        <span>...</span>
    @elseif ($pagination->currentPage >= ($pagination->totalPages - 2))
        <span>...</span>
        @foreach ($pagination->pages as $pageNumber => $path)
            @if($pageNumber > ($pagination->totalPages - 5))
                <a href="{{ $path }}"
                class="{{ $pagination->currentPage == $pageNumber ? 'selected' : '' }}">
                    {{ $page->translateNumber($pageNumber) }}
                </a>
            @endif
        @endforeach
    @else
        <span>...</span>
        @foreach ($pagination->pages as $pageNumber => $path)
            @if($pageNumber >= ($pagination->currentPage - 2) && $pageNumber <= ($pagination->currentPage + 2))
                <a href="{{ $path }}"
                class="{{ $pagination->currentPage == $pageNumber ? 'selected' : '' }}">
                    {{ $page->translateNumber($pageNumber) }}
                </a>
            @endif
        @endforeach
        <span>...</span>
    @endif

    @if ($next = $pagination->next)
        <a href="{{ $next }}"><i class="fas fa-angle-right"></i></a>
        <a href="{{ $pagination->last }}"><i class="fas fa-angle-double-right"></i></a>
    @else
        <span><i class="fas fa-angle-right"></i></span>
        <span><i class="fas fa-angle-double-right"></i></span>
    @endif
</section>
