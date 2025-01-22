function toggleUpAndDown() {
    const button = document.getElementById('cat-button');
    const down = document.getElementById('icon-down');
    const up = document.getElementById('icon-up');

    const aria = button.getAttribute('aria-expanded') === 'true';

    // Toggle icons
    if (aria) {
        down.classList.add('d-none');
        up.classList.remove('d-none');
    } else {
        up.classList.add('d-none');
        down.classList.remove('d-none');
    }
    
}
