setInterval(function () {
    switchImages();
}, 5000);

function switchImages() {
    var homeHeroContainer = document.getElementById('home-hero-image');
    var current = document.querySelector('.active-hero-image');
    current.classList.remove('active-hero-image');
    var next = current.nextElementSibling || homeHeroContainer.firstElementChild;
    next.classList.add('active-hero-image');
}
