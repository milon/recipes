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
            <a href="{{ $page->getCategoryUrl($category) }}" class="{{ $tagClass }}">#{{ $category }}</a>
        @endforeach
    </div>
@endif
