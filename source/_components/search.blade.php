{{-- Search: Alpine.js + Fuse.js — data in source/_assets/js/components/searchData.js --}}
<div
    x-data="search()"
    x-cloak
    class="navbar-search-wrapper position-relative"
>
    <div class="search-bar-row d-flex align-items-center w-100">
        <label for="search-input" class="sr-only">খুঁজুন</label>
        <input
            id="search-input"
            type="text"
            x-ref="searchInput"
            x-model="query"
            class="form-control search-input"
            placeholder="খুঁজুন..."
            autocomplete="off"
            @keydown.esc="reset"
            @keydown="onInputKeydown($event)"
        />
        <button
            type="button"
            x-show="query"
            x-transition
            class="btn btn-link search-cancel"
            @click="reset"
            aria-label="বাতিল"
        >
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div
        x-show="isQuerying"
        x-cloak
        x-transition
        class="search-panel position-absolute bg-white border rounded shadow-sm py-0 left-0 right-0"
        style="top: 100%; margin-top: 0.25rem; max-height: 350px; overflow-y: auto; z-index: 1050;"
    >
        <template x-for="(result, index) in results" :key="result.link">
            <a
                x-ref="resultItem"
                :href="result.link"
                :title="result.title"
                class="search-item d-block px-3 py-2 border-bottom text-dark text-decoration-none"
                :class="{ 'search-item-selected': index === selectedIndexClamped }"
                :aria-selected="index === selectedIndexClamped"
                @mousedown.prevent
            >
                <span class="font-weight-bold" x-text="result.title"></span>
                <span class="search-item-excerpt d-block small text-muted" x-html="result.excerpt || ''"></span>
            </a>
        </template>
        <div
            x-show="isQuerying && !results.length"
            class="px-3 py-2 text-muted small"
        >
            <span x-text="query"></span>-এর জন্যে কোন ফলাফল পাওয়া যায় নি।
        </div>
    </div>
</div>
