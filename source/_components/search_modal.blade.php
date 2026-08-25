<div
    x-show="open"
    x-cloak
    class="search-modal"
    role="dialog"
    aria-modal="true"
    aria-label="রেসিপি খুঁজুন"
    @click.self="closeModal()"
>
    <div class="search-modal-backdrop" @click="closeModal()"></div>

    <div class="search-modal-panel">
        <div class="search-modal-header">
            <label for="search-modal-input" class="sr-only">খুঁজুন</label>
            <div class="search-modal-input-wrap">
                @include('_components.icon', ['name' => 'search', 'class' => 'icon--sm search-modal-input-icon'])
                <input
                    id="search-modal-input"
                    type="text"
                    role="searchbox"
                    x-ref="searchInput"
                    x-model="query"
                    class="form-control search-modal-input"
                    placeholder="রেসিপির নাম বা উপাদান খুঁজুন..."
                    autocomplete="off"
                    @keydown="onInputKeydown($event)"
                />
            </div>
            <button
                type="button"
                class="search-modal-close btn btn-link"
                @click="closeModal()"
                aria-label="বন্ধ করুন"
            >
                @include('_components.icon', ['name' => 'close', 'class' => 'icon--sm'])
            </button>
        </div>

        <div class="search-modal-body">
            <p
                x-show="!query"
                class="search-modal-hint text-muted small mb-0"
            >
                <kbd>/</kbd> চাপ দিয়ে যেকোনো পাতা থেকে খুঁজুন
            </p>

            <div x-show="query" class="search-results">
                <template x-for="(result, index) in results" :key="result.link">
                    <a
                        x-ref="resultItem"
                        :href="result.link"
                        :title="result.title"
                        class="search-result-item"
                        :class="{ 'search-result-item-selected': index === selectedIndexClamped }"
                        :aria-selected="index === selectedIndexClamped"
                        @mousedown.prevent
                    >
                        <div class="search-result-thumb">
                            <img
                                x-show="result.image"
                                :src="result.image"
                                :alt="result.title"
                                loading="lazy"
                            />
                            <span
                                x-show="!result.image"
                                class="search-result-thumb-placeholder"
                                aria-hidden="true"
                            >
                                @include('_components.icon', ['name' => 'utensils', 'class' => 'icon--sm'])
                            </span>
                        </div>
                        <div class="search-result-text">
                            <span class="search-result-title" x-text="result.title"></span>
                            <span
                                x-show="result.excerpt"
                                class="search-result-excerpt"
                                x-text="result.excerpt"
                            ></span>
                        </div>
                    </a>
                </template>

                <div
                    x-show="query && !results.length"
                    class="search-no-results"
                >
                    <span x-text="query"></span>-এর জন্যে কোন ফলাফল পাওয়া যায় নি।
                </div>
            </div>
        </div>
    </div>
</div>
