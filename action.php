<?php
include 'dbcon.php';

header('Content-type: application/json');

$response = array();
$action = $_REQUEST['action'] ?? '';

if ($action === 'fetch_products') {
    $products = array();

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

    }
    $response['status'] = 'success';
    $response['data'] = $products;
    echo json_encode($response);
}

if($action === 'create'){
    $productName = $_POST['productName'];
    $stocks = (int)$_POST['stocks'];

    $sql = "INSERT INTO products(product_name, stocks) VALUES ('$productName', $stocks)";
    $query = $conn->query($sql);
    if($query){
        $response['status'] = 'success';
        $response['msg'] = 'Product added successfully';
        $response['alert_type'] = 'success';
    }
    echo json_encode($response);
}

if($action === 'get_edit'){
    $productID = $_GET['id'];

    $sql = "SELECT product_name, stocks FROM products WHERE product_id = $productID";
    $result = $conn->query($sql);
    if($result){
        $productDetails = $result->fetch_assoc();
    }
    $response['status'] = 'success';
    $response['productDetails'] = $productDetails;
    echo json_encode($response);
}

if($action === 'update'){
    $productName = $_POST['productName'];
    $stocks = $_POST['stocks'];
    $product_id = $_POST['productID'];

    $sql = "UPDATE products SET product_name = '$productName', stocks = $stocks WHERE product_id = $product_id";
    $query = $conn->query($sql);
    if($query){
        $response['status'] = 'success';
        $response['msg'] = 'Product updated successfully';
        $response['alert_type'] = 'success';
    }
    echo json_encode($response);
}

if($action === 'delete'){
    $product_id = $_POST['productid'];
    
    $sql = "DELETE FROM products WHERE product_id = $product_id";
    $query = $conn->query($sql);

    if($query){
        $response['status'] = 'success';
        $response['msg'] = 'Product deleted successfully';
        $response['alert_type'] = 'danger';
    }
    echo json_encode($response);
}