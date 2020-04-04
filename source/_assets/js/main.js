// Bootstrap core JavaScript
import 'bootstrap';

// dynamically change background in every 20 seconds
setInterval(function() {
    let random = Math.floor(Math.random() * 10) + 1;
    let imageUrl = `/assets/images/backgrounds/bg-${random}.jpg`;
    let banner = document.querySelector('#banner');
    banner.style.backgroundImage = `url(${imageUrl})`;
}, 20*1000);
