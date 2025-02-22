<?php
include 'connect.php';

if (isset($_GET['barcode'])) {
    $barcode = $_GET['barcode'];
    $sql = "DELETE FROM products WHERE barcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barcode);

    if ($stmt->execute()) {
        echo "Product deleted successfully.";
        header("Location: admindashboard.php");
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    die("Invalid request!");
}
?>
