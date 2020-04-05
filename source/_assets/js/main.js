// Bootstrap core JavaScript
import 'bootstrap';

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
