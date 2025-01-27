document.addEventListener('DOMContentLoaded', () => {
    const badge = document.getElementById('cart-badge');
    const cartCount = parseInt(badge.textContent, 10);

    if (cartCount > 0) {
        badge.style.display = 'inline-block';
    } else {
        badge.style.display = 'none';
    }
});

