window.addEventListener('go-to-listing', event => {
    window.location = event.detail.url;
});

window.addEventListener('scroll-to-trials', event => {
    document.querySelector('#recruiting-trial-results').scrollIntoView()
});

Livewire.on('gotoTop', () => {
    document.querySelector('#recruiting-trials-eligibility').scrollIntoView()
});
