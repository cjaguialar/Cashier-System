<?php
include 'functions/connect.php';

?>
<?php
  $sql = "SELECT * FROM products ORDER BY name";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>{$row['barcode']}</td>";
          echo "<td>{$row['name']}</td>";
          echo "<td>{$row['price']}</td>";
          echo "<td>{$row['stock']}</td>";
          echo "<td class='action-container'>";
          echo "<a href='functions/product_edit.php?barcode={$row['barcode']}' class='actions'> Edit</a>";
          echo "<a href='functions/product_delete.php?barcode={$row['barcode']}' class='actions'> Delete</a>";
          echo "</td></tr>";
      }
  } else {
      echo "<tr><td colspan='5'>No products found.</td></tr>";
  }
?>
