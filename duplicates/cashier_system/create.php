<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barcode = $_POST['barcode'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_name = $_POST['category_name'];
    
    $sql = "INSERT INTO products (barcode, name, price, stock, category_name) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $barcode, $name, $price, $stock, $category_name);
    
    if ($stmt->execute()) {
        echo "Product added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    
    $stmt->close();
}
?>