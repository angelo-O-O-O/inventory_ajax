$(document).ready(function () {
    fetchProducts();
    function showAlert(alert_type, message) {
        $('#alertBox').html(`
            <div class="alert alert-${alert_type}" alert-dismissible fade show">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            `)
    }

    const productModal = new bootstrap.Modal(document.getElementById('productModal'));
    const newProductBtn = $('#newProduct');

    newProductBtn.click(function () {
        $('#productForm')[0].reset;
        $('#modalTitle').text('Add New Product');
        $('#productID').val('');
        productModal.show();
    })

    $('#productForm').submit(function (e) {
        e.preventDefault();

        const productID = $('#productID').val();
        const action = productID ? 'update' : 'create';

        $.ajax({
            url: `action.php?action=${action}`,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',

            success: function (res) {
                if (res === 'success') {
                    productModal.hide();
                    showAlert(res.alert_type, res.msg);
                    fetchProducts();
                } else {
                    productModal.hide();
                    showAlert(res.alert_type, res.msg);
                    fetchProducts();
                }
            }
        })
    })

    function fetchProducts() {
        $.ajax({
            url: `action.php?action=fetch_products`,
            type: 'POST',
            dataType: 'json',

            success: function (res) {
                let products = '';
                if (res.status === 'success' && res.data.length > 0) {
                    res.data.forEach(product => {
                        let statusDisplay = getStatus(Number(product.stocks));
                        products += `
                    <tr class="text-center">
                        <td>${product.product_id}</td>
                        <td>${product.product_name}</td>
                        <td>${product.stocks}</td>
                        ${statusDisplay}
                        <td>
                            <button type="button" class="btn btn-warning btn-edit" data-id=${product.product_id}>Edit</button>
                            <button type="button" class="btn btn-danger btn-delete text-light" data-id=${product.product_id}>Delete</button>
                        </td>
                        <td>${product.created_at}</td>
                    </tr>
                    `
                    })
                } else {
                    products += `
                    <tr>
                        <td colspan="6" class="text-center">No products found.</td>
                    </tr>
                    `
                }
                $('#productList').html(products);
            }
        })
    }
    function getStatus(stocks) {
        if (stocks <= 5 && stocks > 0) {
            return `<td class="bg-warning text-light">Low stocks</td>`;
        } else if (stocks === 0) {
            return `<td class="bg-danger text-light">Out of Stocks</td>`;
        } else {
            return `<td class="bg-success text-light">Available</td>`;
        }
    }

    $(document).on('click', '.btn-edit', function () {
        const productId = $(this).data('id');

        $.ajax({
            url: `action.php?action=get_edit&id=${productId}`,
            type: 'GET',
            dataType: 'json',

            success: function (res) {
                if (res.status === 'success') {
                    $('#productForm')[0].reset();
                    $('#productID').val(productId);
                    $('#modalTitle').text('Edit Product');
                    $('#productName').val(res.productDetails.product_name);
                    $('#stocks').val(res.productDetails.stocks);
                    productModal.show();
                    fetchProducts();
                }
                else {
                    showAlert(res.alert_type, res.msg);
                    exit();
                }
            }
        })
    })

    $(document).on('click', '.btn-delete', function () {
        const product_id = $(this).data('id');

        if (confirm('Are you sure you want to delete?')) {
            $.ajax({
                url: `action.php?action=delete`,
                type: 'POST',
                data: { productid: product_id },
                dataType: 'json',

                success: function (res) {
                    if (res.status === 'success') {
                        showAlert(res.alert_type, res.msg);
                        fetchProducts();
                    }
                }
            })
        }
    })
})