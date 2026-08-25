// Search: Alpine.js + Fuse.js (per Jigsaw blog template)
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

// Sticky navbar on scroll (from Start Bootstrap Clean Blog)
(function initNavbarScroll() {
    const nav = document.getElementById('mainNav');
    if (!nav || window.innerWidth <= 992) {
        return;
    }

    let previousTop = 0;
    const headerHeight = nav.offsetHeight;

    window.addEventListener('scroll', () => {
        const currentTop = window.scrollY;

        if (currentTop < previousTop) {
            if (currentTop > 0 && nav.classList.contains('is-fixed')) {
                nav.classList.add('is-visible');
            } else {
                nav.classList.remove('is-visible', 'is-fixed');
            }
        } else if (currentTop > previousTop) {
            nav.classList.remove('is-visible');
            if (currentTop > headerHeight && !nav.classList.contains('is-fixed')) {
                nav.classList.add('is-fixed');
            }
        }

        previousTop = currentTop;
    });
})();

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
