<template>
    <form class="form-inline my-3 my-lg-0 position-relative">
        <input
            id="search"
            v-model="query"
            ref="search"
            class="form-control"
            type="text"
            placeholder="খুঁজুন..."
            @keyup.esc="reset"
        >
        <button
            v-show="query"
            class="position-absolute btn btn-link cancel-btn"
            @click="reset"
        ><i class="fas fa-times"></i></button>

        <div v-if="query" class="position-absolute search-panel">
            <div class="search-scroll">
                <a
                    v-for="(result, index) in results"
                    class="search-item"
                    :href="result.link"
                    :title="result.title"
                    :key="result.link"
                    @mousedown.prevent>

                    {{ result.title }}

                    <span class="excerpt" v-html="result.excerpt"></span>
                </a>
            </div>

            <div v-if="! results.length" class="">
                <span class="no-result">{{ query }}-এর জন্যে কোন ফলাফল পাওয়া যায় নি।</span>
            </div>

        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            fuse: null,
            query: '',
        };
    },
    computed: {
        results() {
            return this.query ? this.fuse.search(this.query) : [];
        },
    },
    methods: {
        reset() {
            this.query = '';
        },
    },
    created() {
        axios('/index.json').then(response => {
            this.fuse = new fuse(response.data, {
                minMatchCharLength: 6,
                limit: 7,
                keys: ['title', 'excerpt', 'englishSearchTerm'],
            });
        });
    },
};
</script>

<style>
    #search {
        width: 350px !important;
        border-radius: 0;
    }

    #search:focus {
        border-color: #ced4da;
        box-shadow: none;
    }

    .cancel-btn {
        right: 0;
        color: #495057;
    }

    .cancel-btn:hover {
        color: #495057;
    }

    .search-panel {
        width: 100%;
        left: 0;
        right: 0;
        background: white;
        top: 100%;
    }

    .no-result {
        font-size: 16px;
        padding: 5px 8px;
    }

    .search-item {
        text-decoration: none !important;
        display: block;
        padding: 5px 8px;
        border-bottom: 1px solid #ccc;
        font-size: 16px;
        font-weight: bold;
    }

    .search-item .excerpt {
        font-size: 13px;
        display: block;
        color: #bababa;
        font-weight: normal;
    }
</style>
