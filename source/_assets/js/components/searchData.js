/**
 * Alpine.js data component for the search bar (Fuse.js).
 * Used in source/_components/search.blade.php as x-data="search()"
 */
export default function search() {
  return {
    fuse: null,
    query: '',
    selectedIndex: 0,

    init() {
      fetch('/index.json')
        .then((response) => response.json())
        .then((data) => {
          const list = Array.isArray(data) ? data : Object.values(data || {});
          this.fuse = new window.Fuse(list, {
            minMatchCharLength: 1,
            threshold: 0.4,
            keys: ['title', 'excerpt', 'englishSearchTerm', 'categories'],
          });
        })
        .catch(() => {
          this.fuse = new window.Fuse([], { keys: ['title'] });
        });

      this.$watch('query', () => {
        this.selectedIndex = 0;
      });

      const focusSearch = () => {
        this.$nextTick(() => {
          const input = this.$refs.searchInput;
          if (input) {
            input.focus();
            const collapse = document.querySelector('#navbarResponsive');
            if (
              collapse &&
              collapse.classList.contains('collapse') &&
              !collapse.classList.contains('show')
            ) {
              collapse.classList.add('show');
            }
          }
        });
      };

      window.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
          e.preventDefault();
          focusSearch();
        }
      });
    },

    get results() {
      if (!this.query || !this.fuse) return [];
      const raw = this.fuse.search(this.query, { limit: 7 });
      return raw.map((r) => (r.item != null ? r.item : r));
    },

    get isQuerying() {
      return Boolean(this.query);
    },

    get selectedIndexClamped() {
      const n = this.results.length;
      return n ? Math.min(this.selectedIndex, n - 1) : 0;
    },

    reset() {
      this.query = '';
      this.selectedIndex = 0;
    },

    onInputKeydown(e) {
      if (e.key === 'Escape') return;
      const r = this.results;
      const n = r.length;
      if (n === 0) return;
      this.selectedIndex = Math.min(this.selectedIndex, n - 1);
      if (e.key === 'ArrowDown') {
        e.preventDefault();
        this.selectedIndex = (this.selectedIndex + 1) % n;
        this.$nextTick(() => this.scrollSelectedIntoView());
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        this.selectedIndex = (this.selectedIndex - 1 + n) % n;
        this.$nextTick(() => this.scrollSelectedIntoView());
      } else if (e.key === 'Enter') {
        e.preventDefault();
        window.location.href = r[this.selectedIndexClamped].link;
      }
    },

    scrollSelectedIntoView() {
      const refs = this.$refs.resultItem;
      const el = Array.isArray(refs) ? refs[this.selectedIndexClamped] : refs;
      if (el && el.scrollIntoView) {
        el.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
      }
    },
  };
}
