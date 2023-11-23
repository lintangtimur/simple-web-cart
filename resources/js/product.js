import './bootstrap';


toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-bottom-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
      document.addEventListener('DOMContentLoaded', function () {
          const addToCartButtons = document.querySelectorAll('.add-to-cart');
          
          const checkoutButton = document.getElementById('checkout-btn');
  
          addToCartButtons.forEach(button => {
              button.addEventListener('click', function () {
                  const productId = this.getAttribute('data-product-id');
                  const quantity = document.getElementById('quantity_'+productId).value;
                  axios.post('/cart/add', { productId, quantity })
                      .then(response => {
                          console.log(response.data);
                          toastr.success('Berhasil menambahkan item ke dalam cart', 'Sukses')
                          
                      })
                      .catch(error => {
                          console.error(error);
                          // Tampilkan pesan kesalahan di sini
                      });
              });
          });
  
          checkoutButton.addEventListener('click', function () {
              // Redirect ke halaman summary
              window.location.href = '/summary';
          });
      });