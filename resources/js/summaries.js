import './bootstrap';

window.increaseQuantity = increaseQuantity
window.decreaseQuantity = decreaseQuantity
window.updateQuantity = updateQuantity

function decreaseQuantity(cartId) {
    var quantityInput = document.getElementById('quantity_'+cartId);
    var currentValue = parseInt(quantityInput.value, 10);
    quantityInput.value = currentValue > 1 ? currentValue - 1 : 0;
    updateSubTotal(quantityInput.value, cartId)
}

function increaseQuantity(cartId) {
    var quantityInput = document.getElementById('quantity_'+cartId);
    var currentValue = parseInt(quantityInput.value, 10);
    quantityInput.value = currentValue + 1;
    updateSubTotal(quantityInput.value, cartId)
}

function updateQuantity(cartId, quantity) {
    var quantityInput = document.getElementById('quantity_'+cartId);
    var newValue = parseInt(quantityInput.value, 10);
    quantityInput.value = isNaN(newValue) || newValue < 1 ? 0 : newValue;
    updateSubTotal(quantityInput.value, cartId)
}

function updateSubTotal(quantity, cartId){
    axios.post('/cart/update', { cartId, quantity })
    .then(response => {
        console.log(response.data);
        var updatePriceElement = document.querySelector('.updatePrice_'+cartId);
        var totalCost = document.querySelector('.totalCost');
        var totalHidden = document.querySelector('.totalHidden');
        var kupon50 = document.querySelector('.kupon50');
        var kupon100 = document.querySelector('.kupon100');

        // Ganti nilai HTML elemen dengan nilai yang baru
        updatePriceElement.innerHTML = response.data.harga; // Gantilah 'Nilai Baru' dengan nilai yang diinginkan
        totalCost.innerHTML = response.data.total;
        totalHidden.innerHTML = response.data.total;
        kupon50.innerHTML = "Kupon 50 ribu : "+ response.data.update.summaries.kupon_50rb;
        kupon100.innerHTML =  "Kupon kelipatan 100 ribu :"+ response.data.update.summaries.kupon_100rb;
        
    })
    .catch(error => {
        console.error(error);
        // Tampilkan pesan kesalahan di sini
    });
}
