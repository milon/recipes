<div class="mt-3">
    @foreach($page->categories ?? [] as $category)
        <span class="badge badge-pill category recipe-tag">{{ $category }}</span>
    @endforeach
</div>
