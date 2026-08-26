@php
    $categories = collect($categories ?? $page->categories ?? [])->filter();
    if (!empty($limit)) {
        $categories = $categories->take($limit);
    }
    $tagClass = trim('recipe-tag ' . ($class ?? ''));
@endphp
@if ($categories->isNotEmpty())
    <div class="{{ $wrapperClass ?? 'recipe-detail-tags' }}">
        @foreach ($categories as $category)
            <span class="{{ $tagClass }}">#{{ $category }}</span>
        @endforeach
    </div>
@endif
