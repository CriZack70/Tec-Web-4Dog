// Custom alert notification
function showMessage(message, isSuccess) {
    const toastElement = document.getElementById('toastMessage');
    const toastText = document.getElementById('toastText');

    toastText.textContent = message;
    toastElement.classList.remove('bg-danger', 'bg-success');
    toastElement.classList.add(isSuccess ? 'bg-success' : 'bg-danger');

    const toast = new bootstrap.Toast(toastElement);
    toast.show();
}

let selectedCardID = null;

function confirmDeleteCard(cardID) {
    selectedCardID = cardID;
    const modal = new bootstrap.Modal(document.getElementById('deletePaymentModal'));
    modal.show();
}



async function addPaymentMethod() {
    const form = document.getElementById('addPaymentForm');
    const formData = new FormData(form);
    formData.append('azione', 'add');
    try {
        const response = await fetch('utils/payments.php', {
        method: 'POST',
        body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["aggiuntoPagamento"]) {
            location.reload();
        } else {
            showMessage("Failed to add payment method.", false);
        }
    } catch (error) {
        console.log(error.message);
    }
}

async function deletePaymentMethod() {

    const formData = new FormData();
    formData.append('CardNumber', selectedCardID);
    formData.append('azione', 'delete');
    try {
        const response = await fetch('utils/payments.php', {
        method: 'POST',
        body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["rimossoPagamento"]) {
            location.reload();
        } else {
            showMessage("Failed to remove payment method.", false);
        }
    } catch (error) {
        console.log(error.message);
    }
}
