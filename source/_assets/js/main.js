import Alpine from 'alpinejs';
import search from './components/searchData.js';
import '../sass/main.scss';

Alpine.data('search', search);
Alpine.start();

document.querySelectorAll('.navbar-toggler').forEach((button) => {
    const panelId = button.getAttribute('data-target')?.replace('#', '');
    const panel = panelId ? document.getElementById(panelId) : null;
    if (!panel) {
        return;
    }

    button.addEventListener('click', () => {
        const open = !panel.classList.contains('show');
        panel.classList.toggle('show', open);
        button.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
});

// Crossfade the home hero through the background photos, one every 20 seconds.
(function initHeroRotation() {
    const frame = document.querySelector('[data-hero-rotate]');
    if (!frame || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const layers = Array.from(frame.querySelectorAll('.hero-photo'));
    const total = Number(frame.dataset.heroRotate);
    const template = frame.dataset.heroSrc;
    const webpTemplate = frame.dataset.heroWebpSrc;
    const webpSmallTemplate = frame.dataset.heroWebpSmallSrc;
    const webpMobileTemplate = frame.dataset.heroWebpMobileSrc;
    if (layers.length !== 2 || total < 2 || !template) {
        return;
    }

    let visible = 0;
    let queued = Number(frame.dataset.heroNext);

    const setLayerImage = (layer, imageNumber, onload = null) => {
        const source = layer.closest('picture')?.querySelector('source');
        const large = webpTemplate?.replace('{n}', imageNumber);
        const small = webpSmallTemplate?.replace('{n}', imageNumber);
        const mobile = webpMobileTemplate?.replace('{n}', imageNumber);

        if (source && large) {
            source.srcset = [
                small ? `${small} 640w` : null,
                mobile ? `${mobile} 768w` : null,
                `${large} 1024w`,
            ].filter(Boolean).join(', ');
        }

        if (onload) {
            layer.addEventListener('load', onload, { once: true });
        }
        layer.src = template.replace('{n}', imageNumber);
    };

    const rotate = () => {
        const incoming = layers[1 - visible];
        const outgoing = layers[visible];

        const following = (queued % total) + 1;

        incoming.classList.add('is-visible');
        outgoing.classList.remove('is-visible');
        visible = 1 - visible;

        // Once the crossfade is over, prepare the now-hidden layer.
        window.setTimeout(() => setLayerImage(outgoing, following), 1400);
        queued = following;
    };

    const startRotation = () => window.setTimeout(() => {
        setLayerImage(layers[1], queued, () => {
            window.setTimeout(() => {
                rotate();
                window.setInterval(rotate, 20000);
            }, 5000);
        });
    }, 15000);

    if ('requestIdleCallback' in window) {
        window.requestIdleCallback(startRotation, { timeout: 3000 });
    } else {
        window.setTimeout(startRotation, 1000);
    }
})();

(function initThemeSwitch() {
    const root = document.documentElement;
    const buttons = Array.from(document.querySelectorAll('.theme-switch'));
    const media = window.matchMedia('(prefers-color-scheme: dark)');
    let themeColor = document.querySelector('meta[name="theme-color"]');

    if (!themeColor) {
        themeColor = document.createElement('meta');
        themeColor.name = 'theme-color';
        document.head.appendChild(themeColor);
    }

    const storedTheme = () => {
        try {
            return localStorage.getItem('theme');
        } catch (error) {
            return null;
        }
    };

    const applyTheme = (theme) => {
        const dark = theme === 'dark';
        root.dataset.theme = dark ? 'dark' : 'light';
        themeColor.content = dark ? '#221e1a' : '#eee8de';
        buttons.forEach((button) => {
            button.setAttribute('aria-pressed', dark ? 'true' : 'false');
            button.setAttribute('aria-label', dark ? button.dataset.labelLight : button.dataset.labelDark);
        });
    };

    applyTheme(root.dataset.theme === 'dark' ? 'dark' : 'light');

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const next = root.dataset.theme === 'dark' ? 'light' : 'dark';
            try {
                localStorage.setItem('theme', next);
            } catch (error) {}
            applyTheme(next);
        });
    });

    media.addEventListener('change', (event) => {
        const stored = storedTheme();
        if (stored === 'light' || stored === 'dark') {
            return;
        }
        applyTheme(event.matches ? 'dark' : 'light');
    });
})();

document.querySelectorAll('.recipe-share-btn[data-share]').forEach((btn) => {
    btn.addEventListener('click', () => {
        const pageUrl = encodeURIComponent(btn.dataset.url || '');
        const shareUrls = {
            x: `https://x.com/intent/tweet?url=${pageUrl}`,
            fb: `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`,
            in: `https://www.linkedin.com/shareArticle?mini=true&url=${pageUrl}`,
        };
        const target = shareUrls[btn.dataset.share];
        if (target) {
            window.open(target, '_blank', 'noopener,noreferrer');
        }
    });
});
