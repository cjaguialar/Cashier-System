<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barcode = isset($_POST['barcode']) ? trim(string: $_POST['barcode']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
    $category = isset($_POST['category']) ? trim($_POST['category']) : '';

    if (empty($barcode) || empty($name) || empty($category)) {
        die("Please fill out all required fields.");
    }

    $sql = "INSERT INTO products (barcode, name, price, stock, category_name) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $barcode, $name, $price, $stock, $category);

    if ($stmt->execute()) {
        header("Location: ../admindashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}
?>
