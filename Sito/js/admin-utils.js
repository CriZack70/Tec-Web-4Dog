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

let selectedProductID = null;
let selectedVersionID = null;
let selectedUserID = null;
let selectedCategoryID = null;
let updateUserAction = null;

function confirmUpdateUser(userID, state) {
    selectedUserID = userID;
    updateUserAction = state;
    const modal = new bootstrap.Modal(document.getElementById('changeUserModal'));
    document.getElementById('mainContent').setAttribute('inert', '');
    modal.show();
}

function confirmDeleteVersion(productID, versionID) {
    selectedProductID = productID;
    selectedVersionID = versionID;
    const modal = new bootstrap.Modal(document.getElementById('deleteVersionModal'));
    document.getElementById('mainContent').setAttribute('inert', '');
    modal.show();
}

function confirmDeleteCategory(categoryID) {
    selectedCategoryID = categoryID;
    const modal = new bootstrap.Modal(document.getElementById('deleteCategoryModal'));
    document.getElementById('mainContent').setAttribute('inert', '');
    modal.show();
}

function confirmEditProduct(productID, versionID) {
    selectedProductID = productID;
    selectedVersionID = versionID;
    const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
    document.getElementById('mainContent').setAttribute('inert', '');
    modal.show();
}


// Handle user actions
async function updateUser() {   
    const formData = new FormData();
    formData.append('userId', selectedUserID);
    formData.append('change', updateUserAction);
    try {
            const response = await fetch('utils/users.php', {
            method: "POST",                   
            body: formData
        });
        if (!response.ok) {
            showMessage("Failed to change user state (Maybe it's already there?)", false);
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["utenteAggiornato"]) {
            sessionStorage.setItem('activeTab', 'pills-users-tab');
            if (updateUserAction === 1) {
                showMessage("L'utente è stato attivato con successo.", true);
            } else if (updateUserAction === false) {
                showMessage("L'utente è stato disattivato con successo." , true);
            }
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showMessage("Failed to change user state", false);
        }
    } catch (error) {
        console.log(error.message);
    }

    bootstrap.Modal.getInstance(document.getElementById('changeUserModal')).hide();
    document.getElementById('mainContent').setAttribute('inert', '');
}


// Handle order actions

function openStatusModal(orderID) {
    const numero = document.getElementById('modalOrderID');
    const input = document.getElementById('orderID');

    numero.textContent = orderID;
    input.value = orderID;

    $('#statusModal').modal('show');
}

async function updateOrderStatus() {
    const modalStatus = document.getElementById('statusForm');

    const formData = new FormData(modalStatus);
    formData.append('azione', 'update');

    try {
        const response = await fetch('utils/orders.php', {
        method: 'POST',
        body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["statoAggiornato"]) {
            sessionStorage.setItem('activeTab', 'pills-orders-tab');
            location.reload();
        } else {
            showMessage("Failed to update order", false);
        }
    } catch (error) {
        console.log(error.message);
    }

    const modal = bootstrap.Modal.getInstance(document.getElementById('statusModal'));
    modal.hide();
    document.getElementById('mainContent').setAttribute('inert', '');
}

async function sendNotification(orderID, orderStatus) {
    
    const formData = new FormData();
    formData.append('orderID', orderID);
    formData.append('orderStatus', orderStatus);
    formData.append('azione', 'send');
    
    try {
        const response = await fetch('utils/orders.php', {
        method: 'POST',
        body: formData
        });
        if (!response.ok) {
            showMessage("Failed to send notification (already sent?)", false);
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["notificaInviata"]) {
            showMessage("Notification sent!", true);
            sessionStorage.setItem('activeTab', 'pills-orders-tab');
        } else {
            showMessage("Failed to send notification!", false);
        }
    } catch (error) {
        console.log(error.message);
    }
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
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["prodottoAggiunto"]) {
            sessionStorage.setItem('activeTab', 'pills-products-tab');
            showMessage("Product added correctly. Now add a version.", true);            
            setTimeout(() => {
                location.reload();
            }, 1500);
           
        } else {
            showMessage("Failed to add Product!", false);
        }
    } catch (error) {
        console.log(error.message);
    }

    const modal = bootstrap.Modal.getInstance(document.getElementById('addProductModal'));
    modal.hide();
    document.getElementById('mainContent').setAttribute('inert', '');

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
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["versioneAggiunta"]) {
            sessionStorage.setItem('activeTab', 'pills-products-tab');
            showMessage("Version added correctly.", true);            
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showMessage("Failed to add Version!", false);
        }
    } catch (error) {
        console.log(error.message);
    }

    const modal = bootstrap.Modal.getInstance(document.getElementById('addVersionModal'));
    modal.hide();
    document.getElementById('mainContent').setAttribute('inert', '');

}

async function editProduct() {

    const modalEdit = document.getElementById('editForm');
    
    const formData = new FormData(modalEdit);
    formData.append('CodProdotto', selectedProductID);
    formData.append('Codice', selectedVersionID);
    formData.append('azione', 'edit');
    try {
        const response = await fetch('utils/products.php', {
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
            showMessage("Failed to edit product!", false);
        }
    } catch (error) {
        console.log(error.message);
    }
    document.getElementById('mainContent').removeAttribute('inert');
}

async function deleteProduct() {
    
    const modalDelProd = document.getElementById('DelProdForm');
    const formData = new FormData(modalDelProd);

    formData.append('azione', 'remove');
    try {
            const response = await fetch('utils/products.php', {
            method: "POST",                   
            body: formData
        });
        if (!response.ok) {
            showMessage("Failed to delete Product (Maybe still some version of it?)", false);
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["prodottoEliminato"]) {
            showMessage("Product deleted correctly", true);
            sessionStorage.setItem('activeTab', 'pills-products-tab');
            setTimeout(() => {
                location.reload();
            }, 1500); // Ricarica la pagina dopo 5 secondi
        } else {
            showMessage("Failed to delete Product", false);
        }
    } catch (error) {
        console.log(error.message);
    }
    document.getElementById('mainContent').removeAttribute('inert');  
}

async function deleteVersion() {
    
    const formData = new FormData();
    formData.append('CodProdotto', selectedProductID);
    formData.append('Codice', selectedVersionID);
    formData.append('azione', 'delete');
    try {
            const response = await fetch('utils/products.php',  {
            method: "POST",                   
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        } 
        const json = await response.json();
        if (json["versioneEliminata"]) {
            sessionStorage.setItem('activeTab', 'pills-products-tab');            
                location.reload();           
        } else {
            showMessage("Failed to delete Version!", false);
        }
    } catch (error) {
        console.log(error.message);
    }
    document.getElementById('mainContent').removeAttribute('inert');
}


// Handle Category
async function addCategory() {
    const modalCategory = document.getElementById('addCategoryForm');
    const formData = new FormData(modalCategory);
    formData.append('azione', 'add');

    try {
        const response = await fetch('utils/category.php', {
            method: 'POST',
            body: formData
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        
        if (json["categoriaAggiunta"]) {
            showMessage("Category added successfully", true);
            sessionStorage.setItem('activeTab', 'pills-category-tab');
            setTimeout(() => {
                location.reload();
            }, 1500); // Ricarica la pagina dopo 5 secondi
        } else {
            showMessage("Failed to add category!", false);
        }
    } catch (error) {
        console.log(error.message);
        showMessage("An error occurred while adding the category", false);
    }

    const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));
    modal.hide();
    document.getElementById('mainContent').removeAttribute('inert');
}

async function deleteCategory() {
    const formData = new FormData();
    formData.append('categoryID', selectedCategoryID);
    formData.append('azione', 'delete');
    
    try {
        const response = await fetch('utils/category.php', {
            method: "POST",
            body: formData
        });
        
        if (!response.ok) {
            showMessage("Failed to delete Category (maybe there are products in it?)", false);
            throw new Error(`Response status: ${response.status}`);
        }
        
        const json = await response.json();
        console.log("Response JSON:", json);
        
        if (json["categoriaEliminata"]) {
            showMessage("Category deleted successfully", true);
            sessionStorage.setItem('activeTab', 'pills-category-tab');
            setTimeout(() => {
                location.reload();
            }, 5000);
        } else {
            showMessage("Failed to delete category!", false);
        }
    } catch (error) {
        console.log("Error:", error.message);
        showMessage("An error occurred while deleting the category", false);
    }
    document.getElementById('mainContent').removeAttribute('inert');
}


const activeTab = sessionStorage.getItem('activeTab');
sessionStorage.removeItem('activeTab');
if (activeTab) {
    const tabToShow = document.querySelector(`#${activeTab}`);
    if (tabToShow) {
        tabToShow.click();
    }
}

