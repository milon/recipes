<div class="clearfix">
    @if ($page->getPrevious())
        <a href="{{ $page->getPrevious()->getPath('web') }}" class="float-left">
            <i class="fas fa-angle-left"></i>
            {{ $page->getPrevious()->title }}
        </a>
    @endif
    @if ($page->getNext())
        <a href="{{ $page->getNext()->getPath('web') }}" class="float-right">
            {{ $page->getNext()->title }}
            <i class="fas fa-angle-right"></i>
        </a>
    @endif
</div>
