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

// Rotate homepage hero background every 15 seconds
function setAutoChangingBackground(cssSelector, durationInSeconds = 15, imageCount = 10) {
    const element = document.querySelector(cssSelector);
    if (!element) {
        return;
    }

    let currentIndex = null;

    const pickRandomImage = () => {
        let nextIndex;
        do {
            nextIndex = Math.floor(Math.random() * imageCount) + 1;
        } while (nextIndex === currentIndex && imageCount > 1);
        currentIndex = nextIndex;
        return `/assets/images/backgrounds/bg-${nextIndex}.jpg`;
    };

    setInterval(() => {
        element.style.backgroundImage = `url(${pickRandomImage()})`;
    }, durationInSeconds * 1000);
}

setAutoChangingBackground('.hero-home', 15);
setAutoChangingBackground('#banner', 20);

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
