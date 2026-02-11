function initPiteaHero() {
    const heroInput = document.querySelector('.c-pitea-hero__search-input input[name="s"]');
    const heroSearchButton = document.querySelector('.c-pitea-hero__search-button');

    if (!heroInput || !heroSearchButton) return;

    heroSearchButton.setAttribute('disabled', '');
    heroInput.addEventListener('input', (e) => {
        if (heroInput.value.length > 0) {
            heroSearchButton.removeAttribute('disabled');
        } else {
            heroSearchButton.setAttribute('disabled', '');
        }
    });
}


if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPiteaHero);
} else {
    initPiteaHero();
}