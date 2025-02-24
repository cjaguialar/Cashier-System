<?php

include 'connect.php';


if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

if (isset($_GET['barcode'])) {
    $barcode = $_GET['barcode'];
    $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1;

    // Fetch product by barcode
    $sql = "SELECT * FROM products WHERE barcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            "success" => true,
            "name" => $row["name"],
            "price" => $row["price"]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Product not found"]);
    }
}
$conn->close();
?>
