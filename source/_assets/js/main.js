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
