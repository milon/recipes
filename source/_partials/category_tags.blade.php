<div class="mt-3">
    @foreach($page->categories ?? [] as $category)
        <span class="badge badge-pill badge-secondary category">{{ $category }}</span>
    @endforeach
</div>
