<script>
    document.addEventListener('click', function(event) {
        if (event.target.id === 'add-product') {
            addProductRow();
        }

        if (event.target.classList.contains('remove-product')) {
            const row = event.target.closest('.product-row');
            row.remove();
            updateTotalPrice();
            updateDisabledProducts();
        }
    });

    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('product-select') || event.target.classList.contains('product-quantity')) {
            const row = event.target.closest('.product-row');
            updateRowPrice(row);
            updateTotalPrice();
            updateDisabledProducts();
        }
    });

    function addProductRow() {
        const newRow = `
            <div class="product-row mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control product-select" name="products[${productIndex}][product_id]" required>
                            <option value="">--Pilih Produk--</option>
                            <?php foreach ($products as $product): ?>
                                <option value="<?= esc($product['id']) ?>" data-price="<?= esc($product['price']) ?>">
                                    <?= esc($product['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control product-quantity" name="products[${productIndex}][quantity]" placeholder="Quantity" min="1" value="1" required>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control product-price" name="products[${productIndex}][price]" placeholder="Price" readonly>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control product-total-price" name="products[${productIndex}][total_price]" placeholder="Total Price" readonly>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-product">-</button>
                    </div>
                </div>
            </div>`;

        document.getElementById('products-container').insertAdjacentHTML('beforeend', newRow);
        productIndex++;
        updateDisabledProducts();
    }

    function updateRowPrice(row) {
        const productSelect = row.querySelector('.product-select');
        const quantityInput = row.querySelector('.product-quantity');
        const priceInput = row.querySelector('.product-price');
        const totalPriceInput = row.querySelector('.product-total-price');

        const selectedProductPrice = parseFloat(productSelect.options[productSelect.selectedIndex]?.getAttribute('data-price')) || 0;
        const quantity = parseInt(quantityInput.value) || 1;

        priceInput.value = selectedProductPrice;
        totalPriceInput.value = (selectedProductPrice * quantity);
    }

    function updateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.product-total-price').forEach(input => {
            totalPrice += parseFloat(input.value) || 0;
        });
        document.getElementById('total-price').value = totalPrice;
    }

    function updateDisabledProducts() {
        const selectedValues = Array.from(document.querySelectorAll('.product-select'))
            .map(select => select.value)
            .filter(value => value !== "");

        document.querySelectorAll('.product-select').forEach(select => {
            Array.from(select.options).forEach(option => {
                if (selectedValues.includes(option.value) && option.value !== select.value) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateTotalPrice();
        updateDisabledProducts();
    });
</script>