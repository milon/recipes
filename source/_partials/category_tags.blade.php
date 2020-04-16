<div class="mt-3">
    @foreach($page->categories ?? [] as $category)
        @if(preg_match('/[^A-Za-z0-9]/', $category))
            <span class="badge badge-pill badge-secondary category">{{ $category }}</span>
        @endif
    @endforeach
</div>
