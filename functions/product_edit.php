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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../styles/adminstyle.css">
</head>
<body>

    <div class="sidebar">

    <div class="profile">
      <div class="profile-icon"><ion-icon name="person-outline"></ion-icon></div>
      <div class="profile-name">
      <?php
          session_start();
          if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
              echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
          } else {
              echo "Guest";
      }
      ?>
      </div>
    </div>

    <ul>
      <li class="icon">
        <a href="../admindashboard.php">
          <ion-icon name="cart-outline"></ion-icon>
          <p>Products</p></a>
      </li>
    </ul>
    </div>

    <div class="categories-header"><nav class="navbar">
      <div><a data-tab-target="#all">
        Edit Product</a>
      </div>
    </nav></div>

    <div class="tab-content2">
        <p class="tab-header">
            Edit Product
        </p>
        <form action="update.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

          <label>Barcode:</label>
          <input type="text" id="barcode2" name="barcode" value="<?php echo $product['barcode']; ?>" readonly><br>

          <label>Name:</label>
          <input type="text" id="name2" name="name" value="<?php echo $product['name']; ?>" required><br>

          <label>Price:</label>
          <input type="number" id="price2" name="price" value="<?php echo $product['price']; ?>" step="0.01" required><br>

          <label>Stock:</label>
          <input type="number" id="stock2" name="stock" value="<?php echo $product['stock']; ?>" required><br>

          <label>Category:</label>
          <select name="category_name" id="category2">
              <option value="">Select a Category</option>
              <?php
              // Fetch distinct categories
              $sql = "SELECT DISTINCT category_name FROM products WHERE category_name IS NOT NULL ORDER BY category_name";
              $result = $conn->query($sql);

              // Generate dropdown options
              while ($row = $result->fetch_assoc()) {
                  $selected = ($row['category_name'] == $product['category_name']) ? "selected" : "";
                  echo "<option value='" . htmlspecialchars($row['category_name']) . "' $selected>" . htmlspecialchars($row['category_name']) . "</option>";
              }
              ?>
          </select><br>

          <input type="submit" value="Update Product" class="actions">
        </form>

    </div>

    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js">
  </script>
    
  <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js">
  </script>
</body>
</html>
