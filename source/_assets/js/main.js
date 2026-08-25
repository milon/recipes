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

// Dynamic background rotation for home page
function setAutoChangingBackground(cssSelector, durationInSeconds = 20) {
    setInterval(function () {
        const random = Math.floor(Math.random() * 10) + 1;
        const imageUrl = `/assets/images/backgrounds/bg-${random}.jpg`;
        const banner = document.querySelector(cssSelector);
        if (banner) banner.style.backgroundImage = `url(${imageUrl})`;
    }, durationInSeconds * 1000);
}
setAutoChangingBackground('#banner');

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
