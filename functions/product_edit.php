<?php
include 'connect.php';

if (isset($_GET['barcode'])) {
    $barcode = $_GET['barcode'];
    $sql = "SELECT * FROM products WHERE barcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found!");
    }
} else {
    die("Invalid request!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label>Barcode:</label>
        <input type="text" name="barcode" value="<?php echo $product['barcode']; ?>" readonly><br>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
        <label>Price:</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" step="0.01" required><br>
        <label>Stock:</label>
        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required><br>
        <label>Category:</label>
        <input type="text" name="category_name" value="<?php echo $product['category_name']; ?>"><br>
        <input type="submit" value="Update Product">
    </form>
    <a href="../admindashboard.php">Back to Dashboard</a>
</body>
</html>
