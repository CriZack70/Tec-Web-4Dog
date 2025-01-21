function updateProductDetails(price, availability, version) {
    document.getElementById('price').textContent = price;
    document.getElementById('availability').textContent = availability;
    document.getElementById('version').textContent = version;
    document.getElementById('quantity').value = 1;
}

function updateVersionCode(versionCode) {
    const versionElem = document.getElementById('codVersione');
    versionElem.value = versionCode;
}


function addToList(productId, listType, version, availability) {

    const quantity = document.getElementById('quantity').value;
    
    if (listType === 'cart') {
        if (isNaN(quantity) || quantity < 1) {
            alert('Si prega di inserire un numero maggiore di 0.');
            return;
        }

        if (quantity > parseInt(availability, 10)) {
            alert(`La quantità non può essere maggiore della disponibilità del prodotto.`);
            return;
        }
    }

    fetch('utils/aggiorna-lista.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            product_id: productId,
            version: version,
            list_type: listType,
            quantity: quantity,
        }),
    })
        .then(response => {
            let alertBox = document.getElementsByClassName('alert')[0];
            if (response.ok) {
                alertBox.classList.remove("alert-danger");
                alertBox.classList.add("alert-success");
                alertBox.textContent = "";
                if (listType === 'cart') {
                    alertBox.textContent = "Articolo aggiunto correttamente al Carrello!";
                } else {
                    alertBox.textContent = "Articolo aggiunto correttamente alla Lista Desideri!";
                }
            } else {
                alertBox.classList.remove("alert-success");
                alertBox.classList.add("alert-danger");
                alertBox.textContent = "";
                alertBox.textContent = "Accedi per aggiungere i prodotti alla Lista Desideri o al Carrello!";
            }
            return response.text();
        })
        .catch(error => console.error('Error:', error));
}

const qta = document.getElementById('quantity');
const btnMin = document.getElementsByClassName('btn-minus')[0];
const btnPlus = document.getElementsByClassName('btn-plus')[0];

function decreaseQuantity() {
    value = parseInt(qta.value, 10);
    qta.value--;
    if (value > 1) {
        btnMin.disabled = false;
        btnPlus.disabled = false;
    } else if (value < 1) {
        btnMin.disabled = true;
    }
}

function increaseQuantity() {
    const availability = document.getElementById('availability').textContent;
    qta.value++;
    value = parseInt(qta.value, 10);
    if (value < availability) {
        btnPlus.disabled = false;
        btnMin.disabled = false;
    } else {
        btnPlus.disabled = true;
    }
}