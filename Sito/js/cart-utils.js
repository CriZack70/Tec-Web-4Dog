async function removeFromCart(productId, productVer) {
    const url = 'utils/gestisci-carrello.php';
    const action = 'remove';
    try {
        const response = await fetch(url, { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'remove',
                product_id: productId,
                version: productVer,
            }),
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } else {
            location.reload();
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function updateCart(productId, productVer, qty) {
    const url = 'utils/gestisci-carrello.php';
    try {
        const response = await fetch(url, { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'update',
                product_id: productId,
                version: productVer,
                quantity: qty,
            }),
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
    } catch (error) {
        console.log(error.message);
    }
}

const carrello = document.getElementById('carrello');
const totale = document.getElementById('totale');

function updateCartTotals() {
    let ammontare = 0;

    document.querySelectorAll('.quantita').forEach(input => {
        const prezzo = parseFloat(input.parentElement.nextElementSibling.textContent);
        const quantita = parseInt(input.value, 10) || 1;
        const subtotale = input.closest('tr').querySelector('.totale-riga');

        const totaleRiga = prezzo * quantita;
        subtotale.textContent = `${totaleRiga.toFixed(2)} €`;

        ammontare += totaleRiga;
    });

    totale.textContent = `${ammontare.toFixed(2)} €`;
}

carrello.addEventListener('input', event => {
    if (event.target.classList.contains('quantita')) {
        updateCartTotals();
    }
});