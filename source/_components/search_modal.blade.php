<div
    x-show="open"
    x-cloak
    class="search-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="search-modal-title"
    @click.self="closeModal()"
>
    <div class="search-modal-backdrop" @click="closeModal()"></div>

    <div class="search-modal-panel" x-ref="searchPanel" @keydown.tab="trapFocus($event)">
        <h2 id="search-modal-title" class="sr-only">{{ $page->t('search.title') }}</h2>
        <div class="search-modal-header">
            <label for="search-modal-input" class="sr-only">{{ $page->t('search.label') }}</label>
            <div class="search-modal-input-wrap">
                @include('_components.icon', ['name' => 'search', 'class' => 'icon--sm search-modal-input-icon'])
                <input
                    id="search-modal-input"
                    type="text"
                    role="searchbox"
                    x-ref="searchInput"
                    x-model="query"
                    class="form-control search-modal-input"
                    placeholder="{{ $page->t('search.placeholder') }}"
                    autocomplete="off"
                    @keydown="onInputKeydown($event)"
                />
            </div>
            <button
                type="button"
                class="search-modal-close btn btn-link"
                @click="closeModal()"
                aria-label="{{ $page->t('search.close') }}"
            >
                @include('_components.icon', ['name' => 'close', 'class' => 'icon--sm'])
            </button>
        </div>

        <div class="search-modal-body">
            <p
                x-show="!query"
                class="search-modal-hint text-muted small mb-0"
            >
                <kbd>/</kbd> {{ $page->t('search.hint') }}
            </p>

            <div x-show="query" class="search-results" x-ref="resultsList">
                <template x-for="(result, index) in results" :key="result.link">
                    <a
                        data-search-result
                        :href="result.link"
                        :title="result.title"
                        class="search-result-item"
                        :class="{ 'search-result-item-selected': index === selectedIndexClamped }"
                        :aria-current="index === selectedIndexClamped ? 'true' : null"
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
                    <span x-text="query"></span>{{ $page->t('search.no_results') }}
                </div>
            </div>
        </div>
    </div>
</div>
