<?php
include 'connect.php'; // Ensure this file correctly connects to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $barcode = $_POST['barcode'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    // Check if barcode already exists
    $check_sql = "SELECT barcode FROM products WHERE barcode = '$barcode'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        die("Error: Barcode already exists!");
    }

    // Insert product into the database
    $sql = "INSERT INTO products (barcode, name, price, stock, category_name) 
            VALUES ('$barcode', '$name', '$price', '$stock', '$category')";

    if ($conn->query($sql) === TRUE) {
        $msg = "New product successfully created.";
        header("Location: ../admindashboard.php?message=" . urlencode($msg));
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
