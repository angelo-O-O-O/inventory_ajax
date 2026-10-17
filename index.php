<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">
    <script src="bootstrap5/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h1 class="fw-bold">Inventory</h1>
        <button class="btn btn-primary text-light" id="newProduct">Add products</button>
        <?php include 'productModal.php'; ?>

        <div id="alertBox"></div>
        <div class="card my-5">
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Stocks</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody id="productList"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="jquery-4.0.0.js"></script>
    <script src="script.js"></script>
</body>
</html>