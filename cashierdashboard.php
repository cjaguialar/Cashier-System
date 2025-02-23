<?php 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cashier</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="styles/cashierstyle.css">
</head>
<body>
  
  <div class="container">
    <div class="header">
      <div>
        logo
      </div>

      <div>
        <a href="admindashboard.php">
          <div class="admin-icon"><ion-icon name="person-outline"></ion-icon></div>
        </a>
      </div>
    </div>

    

    <div class="pos">
      <div class="left">
        <div class="product-scan">
          <div class="product-name">
            <div class="barcode">
              <input type="text" name="barcode" id="barcode" placeholder="Barcode">
            </div>
          </div>

          <div class="product-numbers">
            <div class="quantity">
                Quantity: 
                <button class="qty-btn" onclick="decreaseQuantity()">-</button>
                <span id="quantity-value">1</span>
                <button class="qty-btn" onclick="increaseQuantity()">+</button>
            </div>
            <div class="product-price">$4.50</div>
        </div>
        
        </div>
        <div class="product-table">
          <table>
            <tr class="table-title">
              <td>Name</td>
              <td>Quantity</td>
              <td>Price</td>
              <td>Total</td>
            </tr>
            <tr>
<!--tablelogic for showing current session table(sales item)-->
            </tr>
          </table>
        </div>
      </div>
      
      <div class="right">
        <div class="top-right"></div>
        <div class="top-center">
          <div class="total-price">
            <div class="cash">
            <input type="text" name="cash" id="cash" placeholder="Cash">
          </div>
          <div class="total">
              Total
            <div class="price">
<!----> 
            </div>
              Change
            <div class="change">
              $9.00
            </div>
          </div>
        </div>
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
  
</body>
</html>