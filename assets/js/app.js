document.querySelectorAll('.edit-btn').forEach((btn) => {
  btn.addEventListener('click', () => {
    const idInput = document.getElementById('edit-id');
    const nameInput = document.getElementById('edit-name');
    if (idInput && nameInput) {
      idInput.value = btn.getAttribute('data-id') || '';
      nameInput.value = btn.getAttribute('data-name') || '';
    }
  });
});

const productDetailModal = document.getElementById('productDetailModal');
if (productDetailModal) {
  productDetailModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget;
    if (!button) return;

    productDetailModal.querySelector('.modal-title').textContent = button.getAttribute('data-product-title') || '';
    productDetailModal.querySelector('#modalProductImage').src = button.getAttribute('data-product-img') || '';
    productDetailModal.querySelector('#modalProductPrice').textContent = button.getAttribute('data-product-price') || '';
    productDetailModal.querySelector('#modalProductDescription').textContent = button.getAttribute('data-product-desc') || '';
  });
}
