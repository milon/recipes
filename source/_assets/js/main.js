// Bootstrap core JavaScript
import axios from 'axios';
import Fuse from 'fuse.js';
import Vue from 'vue';
import $ from 'jquery';
import Search from './components/Search.vue';
import 'bootstrap';
import '../sass/main.scss';

window.$ = window.jQuery = $;

window.axios = axios;
window.fuse = Fuse;
window.Vue = Vue;

new Vue({
    components: {
        Search,
    },
}).$mount('#vue-search');

function setAutoChangingBackground(cssSelector, durationInSeconds = 20) {
    setInterval(function() {
        let random = Math.floor(Math.random() * 10) + 1;
        let imageUrl = `/assets/images/backgrounds/bg-${random}.jpg`;
        let banner = document.querySelector(cssSelector);
        banner.style.backgroundImage = `url(${imageUrl})`;
    }, durationInSeconds*1000);
}

// dynamically change background in every 20 seconds for home page
setAutoChangingBackground('#banner');
