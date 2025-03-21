<?php 

include ('functions/connect.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="styles/adminstyle.css">
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
        <a href="#">
          <ion-icon name="cart-outline"></ion-icon>
          <p>Products</p></a>
      </li>
    </ul>

    <ul>
      <li class="icon">
        <a href="users.php">
          <ion-icon name="people-outline"></ion-icon>
          <p>Users</p></a>
      </li>
    </ul>

    <ul>
      <li class="icon">
        <a href="functions/sales_report.php">
          <ion-icon name="newspaper-outline"></ion-icon>
          <p>Sale</p></a>
      </li>
    </ul>

    <ul>
      <li class="icon">
        <a href="cashierdashboard.php">
          <ion-icon name="cash-outline"></ion-icon>
          <p>Cashier</p></a>
      </li>
    </ul>

    <ul>
      <li class="logout">
        <a href="loginsystem.php">
          <ion-icon name="log-out-outline"></ion-icon>
          <p>Log Out</p></a>
      </li>
    </ul>
  </div>

  <div class="categories-header">
    <nav class="navbar">
      <div><a data-tab-target="#all">
        All Products</a>
      </div>
      <div><a data-tab-target="#alcohol">
        Alcoholic Beverages</a></div>
      <div><a data-tab-target="#baby">
        Baby Products</a></div>
      <div><a data-tab-target="#bakery">
        Bakery</a></div>
      <div><a data-tab-target="#baking">
        Baking Supplies</a></div>
      <div><a data-tab-target="#enhancers">
        Beverage Enhancers</a></div>
      <div><a data-tab-target="#beverages">
        Beverages</a></div>
      <div><a data-tab-target="#biscuits">
        Biscuits & Wafers</a></div>
      <div><a data-tab-target="#canned">
        Canned Goods</a></div>
      <div><a data-tab-target="#coffee">
        Coffee & Tea</a></div>
      <div><a data-tab-target="#condiment">
        Condiment & Sauces</a></div>
      <div><a data-tab-target="#dairy">
        Dairy</a></div>
      <div><a data-tab-target="#alternatives">
        Dairy Alternatives</a></div>
      <div><a data-tab-target="#dairyfree">
        Dairy-Free Products</a></div>
      <div><a data-tab-target="#fruits">
        Fruits</a></div>
      <div><a data-tab-target="#gluten">
        Gluten Free Items</a></div>
      <div><a data-tab-target="#pet">
        Pet Foods</a></div>
      <div><a data-tab-target="#sanitary">
        Seafood</a></div>
    </nav>
  </div>

  <div class="tab-content">
    <div id="all" data-tab-content class="active">
      <p class="tab-header">
        All Products
      </p>
      <div class="table-container">
        <table>
          <tr class="table-title">
            <td>Barcode</td>
            <td>Name</td>
            <td>Price</td>
            <td>Stock</td>
            <td>Actions</td>
          </tr>
          <?php
            $sql = "SELECT * FROM products ORDER BY name";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
    
          ?>
          <tr>
            
            <td> <?php echo $row['barcode'];?> </td> 
            <td> <?php echo $row['name'];?> </td>
            <td> <?php echo $row['price'];?> </td>
            <td> <?php echo $row['stock'];?> </td>
            <td class="action-container">
            <a href= "functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions" onclick="return true;" > Edit</a>
            <a href= "functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
            </td>
          </tr>
            <?PHP
                      }
                  } //end of while
              ?>
        </table>
      </div>

    <p class="tab-header2">
        Add Products
      </p>
      <div class="table-container2">
          <table>
              <tr class="table-title2">
                  <td>Barcode</td>
                  <td>Name</td>
                  <td>Price</td>
                  <td>Stocks</td>
                  <td>Category</td>
                  <td>Actions</td>
              </tr>
    <tr>
    <form action="functions/add_product.php" method="POST">
        <td><input type="text" id="barcode" name="barcode" placeholder="Enter barcode"></td>
        <td><input type="text" id="name" name="name" placeholder="Enter name"></td>
        <td><input type="number" id="price" name="price" placeholder="Enter price" step="0.01"></td>
        <td><input type="number" id="stocks" name="stock" placeholder="Enter stocks"></td>
        <td>
            <?php
                            // Fetch distinct categories
              $sql = "SELECT DISTINCT category_name FROM products WHERE category_name IS NOT NULL ORDER BY category_name";
              $result = $conn->query($sql);

              // Generate dropdown
              echo "<select name='category' id='category'>";
              echo "<option value=''>Select a Category</option>";
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . htmlspecialchars($row['category_name']) . "'>" . htmlspecialchars($row['category_name']) . "</option>";
              }
              echo "</select>";
            ?>
        
        </td>
        <td class="action-container">
              <button type="submit" class="actions2">Add</button>
        </form>
      </td>
      </tr>
          </table>
      </div>
  </div>
</div>

<div class="tab-content">
    <div id="alcohol" data-tab-content>
      <p class="tab-header">
        Alcohol
      </p>
      <table>
    <tr class="table-title">
      <td>Barcode</td>
      <td>Name</td>
      <td>Price</td>
      <td>Stock</td>
      <td>Actions</td>
    </tr>
    <?php
      $sql = "SELECT * FROM products where category_name ='Alcoholic Beverages' ORDER BY name";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <td> <?php echo htmlspecialchars($row['barcode']); ?> </td>
      <td> <?php echo htmlspecialchars($row['name']); ?> </td>
      <td> <?php echo number_format($row['price'], 2); ?> </td>
      <td> <?php echo (int)$row['stock']; ?> </td>
      <td class="action-container">
        <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
        <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
      </td>
    </tr>
    <?php
        }
      }
    ?>
  </table>

    </div>

    <div id="baby" data-tab-content>
      <p class="tab-header">
        Baby Products
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Baby Products' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="bakery" data-tab-content>
      <p class="tab-header">
        Bakery
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Bakery' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="baking" data-tab-content>
      <p class="tab-header">
        Baking Supplies
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Baking Supplies' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="enhancers" data-tab-content>
      <p class="tab-header">
        Beverage Enhancers
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Beverage Enhancers' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>
    
    <div id="beverages" data-tab-content>
      <p class="tab-header">
        Beverages
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Beverages' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="biscuits" data-tab-content>
      <p class="tab-header">
        Biscuits & Wafers
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Biscuits and Wafers' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="canned" data-tab-content>
      <p class="tab-header">
        Canned Goods
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Canned Goods' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="coffee" data-tab-content>
      <p class="tab-header">
        Coffee & Tea
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Coffee & Tea' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="condiment" data-tab-content>
      <p class="tab-header">
        Condiment & Sauces
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Condiments & Sauces' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="dairy" data-tab-content>
      <p class="tab-header">
        Dairy
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Dairy' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="alternatives" data-tab-content>
      <p class="tab-header">
        Dairy Alternatives
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Dairy' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>
    
    <div id="dairyfree" data-tab-content>
      <p class="tab-header">
        Dairy Free Products
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Dairy-Free Products' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="fruits" data-tab-content>
      <p class="tab-header">
        Fruits
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Fruits' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="gluten" data-tab-content>
      <p class="tab-header">
        Gluten Free Items
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Gluten-Free Items' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>
    

    <div id="pet" data-tab-content>
      <p class="tab-header">
        Pet Foods
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Pet Food' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>

    <div id="sanitary" data-tab-content>
      <p class="tab-header">
        Seafood
      </p>
      <table>
        <tr class="table-title">
          <td>Barcode</td>
          <td>Name</td>
          <td>Price</td>
          <td>Stock</td>
          <td>Actions</td>
        </tr>
        <?php
          $sql = "SELECT * FROM products WHERE category_name='Seafood' ORDER BY name";
          $result = $conn->query($sql);
          echo "<br>";
          if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          
        ?>
        <tr>
          <td> <?php echo $row['barcode'];?> </td> 
          <td> <?php echo $row['name'];?> </td>
          <td> <?php echo $row['price'];?> </td>
          <td> <?php echo $row['stock'];?> </td>
          <td class="action-container">
      <a href="functions/product_edit.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Edit</a>
      <a href="functions/product_delete.php?barcode=<?php echo $row['barcode']; ?>" class="actions"> Delete</a>
          </td>
        </tr>
          <?PHP
                    }
                } //end of while
            ?>
      </table>
    </div>
    </div>

  </div>

  <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js">
  </script>
    
  <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js">
  </script>

  <script>
    const tags = document.querySelectorAll('[data-tab-target]');
    const tabContents = document.querySelectorAll('[data-tab-content]');

    tags.forEach(tag => {
        tag.addEventListener('click', (event) => {
            event.preventDefault(); 

            const targetId = tag.dataset.tabTarget;
            const target = document.querySelector(targetId);

            if (!target) return; 

            
            tabContents.forEach(tabContent => {
                tabContent.classList.remove('active');
            });

            
            target.classList.add('active');
        });
    });
</script>


</body>
</html>