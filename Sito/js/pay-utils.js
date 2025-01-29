async function addPaymentMethod() {
    const form = document.getElementById('addPaymentForm');
    const formData = new FormData(form);
    formData.append('azione', 'add');
    try {
        const response = await fetch('utils/payments.php', {
        method: 'POST',
        body: formData
        });
        console.log(response);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        console.log(json);
        if (json["aggiuntoPagamento"]) {
            location.reload();
        } else {
            alert('Failed to add payment method');
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function deletePaymentMethod(cardNumber) {
    if (confirm('Are you sure you want to delete this payment method?')) {
        const formData = new FormData();
        formData.append('CardNumber', cardNumber);
        formData.append('azione', 'delete');
        try {
            const response = await fetch('utils/payments.php', {
            method: 'POST',
            body: formData
            });
            console.log(response);
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            } 
            const json = await response.json();
            console.log(json);
            if (json["rimossoPagamento"]) {
                location.reload();
            } else {
                alert('Failed to remove payment method');
            }
        } catch (error) {
            console.log(error.message);
        }
    }
}