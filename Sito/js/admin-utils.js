// Handle user actions
async function deleteUser(userId) {
    if (confirm("Volete davvero eliminare questo utente?")) {
        const url = 'utils/users.php';
        const formData = new FormData();
        formData.append('userId', userId);
        try {
                const response = await fetch(url, {
                method: "POST",                   
                body: formData
            });
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            } 
            const json = await response.json();
            if (json["utenteEliminato"]) {
                sessionStorage.setItem('activeTab', 'pills-users-tab');
                location.reload();
            } else {
                alert('Failed to delete user');
            }
        } catch (error) {
            console.log(error.message);
        }
    }
}

// Handle order actions
function updateOrderStatus(orderId) {
    const status = prompt("Enter the new status for the order:");
    if (status) {
        fetch('orders.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=updateStatus&orderId=${orderId}&status=${encodeURIComponent(status)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Order status updated successfully!');
                location.reload();
            } else {
                alert('Failed to update order status: ' + data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function sendNotification(orderId) {
    fetch('orders.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=notify&orderId=${orderId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Notification sent successfully!');
        } else {
            alert('Failed to send notification: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Handle product actions

async function addProduct() {
    
    const modalProd = document.getElementById('addProductForm');

    const formData = new FormData(modalProd);
    formData.append('azione', 'new');

    try {
        const response = await fetch('utils/products.php', {
        method: 'POST',
        body: formData
        });
        console.log(response);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        console.log(json);
        if (json["prodottoAggiunto"]) {
            sessionStorage.setItem('activeTab', 'pills-products-tab');
            location.reload();
        } else {
            alert('Failed to add product');
        }
    } catch (error) {
        console.log(error.message);
    }

    const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
    modal.hide();

}

async function addVersion() {
    
    const modalVersion = document.getElementById('addVersionForm');

    const formData = new FormData(modalVersion);
    formData.append('azione', 'add');

    try {
        const response =await fetch('utils/products.php', {
        method: 'POST',
        body: formData
        });
        console.log(response);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        console.log(json);
        if (json["versioneAggiunta"]) {
            sessionStorage.setItem('activeTab', 'pills-products-tab');
            location.reload();
        } else {
            alert('Failed to add version');
        }
    } catch (error) {
        console.log(error.message);
    }

    const modal = bootstrap.Modal.getInstance(document.getElementById('addVersionModal'));
    modal.hide();

}


async function editProduct(productId, productVer) {
    const productQnt = prompt("Inserisci una nuova disponibilità per il prodotto:");
    const productPrice = prompt("Inserisci il nuovo prezzo del prodotto:");
    if (productQnt && productPrice) {
        const url = 'utils/products.php';
        const formData = new FormData();
        formData.append('CodProdotto', productId);
        formData.append('Codice', productVer);
        formData.append('Disponibilita', productQnt);
        formData.append('Prezzo', productPrice);
        formData.append('azione', 'edit');
        console.log(formData);
        try {
            const response = await fetch(url, {
            method: "POST",                   
            body: formData
            });
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            } 
            const json = await response.json();
            if (json["prodottoModificato"]) {
                sessionStorage.setItem('activeTab', 'pills-products-tab');
                location.reload();
            } else {
                alert('Failed to edit product');
            }
        } catch (error) {
            console.log(error.message);
        }
    }
}

async function deleteProduct(productId, productVer) {
    if (confirm("Volete davvero eliminare questo prodotto?")) {
        const url = 'utils/products.php';
        const formData = new FormData();
        formData.append('CodProdotto', productId);
        formData.append('Codice', productVer);
        formData.append('azione', 'delete');
        try {
                const response = await fetch(url, {
                method: "POST",                   
                body: formData
            });
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            } 
            const json = await response.json();
            if (json["prodottoEliminato"]) {
                sessionStorage.setItem('activeTab', 'pills-products-tab');
                location.reload();
            } else {
                alert('Failed to delete product');
            }
        } catch (error) {
            console.log(error.message);
        }
    }
}

const activeTab = sessionStorage.getItem('activeTab');
sessionStorage.removeItem('activeTab');
if (activeTab) {
    const tabToShow = document.querySelector(`#${activeTab}`);
    if (tabToShow) {
        tabToShow.click();
    }
}
