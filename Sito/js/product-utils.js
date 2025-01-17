function updateProductDetails(price, availability, version) {
    // Update price and availability in the DOM
    document.getElementById('price').textContent = price;
    document.getElementById('availability').textContent = availability;
    document.getElementById('version').textContent = version;
}