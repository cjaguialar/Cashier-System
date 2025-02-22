include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_name = $_POST['category_name'];
    
    $sql = "UPDATE products SET name=?, price=?, stock=?, category_name=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $name, $price, $stock, $category_name, $id);
    
    if ($stmt->execute()) {
        echo "Product updated successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    
    $stmt->close();
}
?>