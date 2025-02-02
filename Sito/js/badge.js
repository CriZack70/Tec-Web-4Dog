document.addEventListener('DOMContentLoaded', () => {
    const badge = document.getElementById('cart-badge');

    if (badge) { // Verifica se l'elemento esiste
        const cartCount = parseInt(badge.textContent, 10);

        if (cartCount > 0) {
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }
    } else {
        console.warn('Elemento con ID "cart-badge" non trovato.');
    }
});