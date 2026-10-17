<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="productForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="productID" name="productID">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stocks</label>
                        <input class="form-control" id="stocks" name="stocks" placeholder="Enter stocks (number only)" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="addProduct">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>