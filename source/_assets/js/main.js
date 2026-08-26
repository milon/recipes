import Alpine from 'alpinejs';
import Fuse from 'fuse.js';
import search from './components/searchData.js';

window.Alpine = Alpine;
window.Fuse = Fuse;

Alpine.data('search', search);

import 'bootstrap';
import '../sass/main.scss';

// Bootstrap + jQuery for nav and other components
import $ from 'jquery';
window.$ = window.jQuery = $;

Alpine.start();

// Crossfade the home hero through the background photos, one every 20 seconds.
(function initHeroRotation() {
    const frame = document.querySelector('[data-hero-rotate]');
    if (!frame || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const layers = Array.from(frame.querySelectorAll('.hero-photo'));
    const total = Number(frame.dataset.heroRotate);
    const template = frame.dataset.heroSrc;
    if (layers.length !== 2 || total < 2 || !template) {
        return;
    }

    let visible = 0;
    let queued = Number(frame.dataset.heroNext);

    setInterval(() => {
        layers[1 - visible].classList.add('is-visible');
        layers[visible].classList.remove('is-visible');
        visible = 1 - visible;

        // Load the following photo into the layer that just faded out, waiting
        // for the crossfade to finish so the swap is never visible.
        const outgoing = layers[1 - visible];
        const following = (queued % total) + 1;
        const preload = new Image();

        preload.onload = () => window.setTimeout(() => {
            outgoing.src = preload.src;
        }, 1400);

        preload.src = template.replace('{n}', following);
        queued = following;
    }, 20000);
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
