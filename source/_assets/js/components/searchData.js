/**
 * Alpine.js search overlay (Fuse.js).
 * Used in source/_components/search.blade.php as x-data="search()"
 */
export default function search() {
  return {
    fuse: null,
    query: '',
    selectedIndex: 0,
    open: false,

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

      window.addEventListener('keydown', (e) => {
        if (e.key !== '/' || e.metaKey || e.ctrlKey || e.altKey) {
          return;
        }

        const target = e.target;
        const tag = target.tagName;
        if (
          tag === 'INPUT'
          || tag === 'TEXTAREA'
          || tag === 'SELECT'
          || target.isContentEditable
        ) {
          return;
        }

        e.preventDefault();
        this.openModal();
      });
    },

    openModal() {
      this.open = true;
      document.body.classList.add('search-modal-open');
      this.$nextTick(() => {
        const input = this.$refs.searchInput;
        if (input) {
          input.focus();
        }
      });
    },

    closeModal() {
      this.open = false;
      document.body.classList.remove('search-modal-open');
      this.reset();
    },

    get results() {
      if (!this.query || !this.fuse) return [];
      const raw = this.fuse.search(this.query, { limit: 12 });
      return raw.map((r) => (r.item != null ? r.item : r));
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
      if (e.key === 'Escape') {
        e.preventDefault();
        this.closeModal();
        return;
      }

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
