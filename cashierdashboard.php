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
            <input type="text" name="barcode" id="barcode" placeholder="Scan Barcode" autofocus>
            </div>
          </div>

          <div class="product-numbers">
            <div class="quantity">
                Quantity:
                <button class="qty-btn" onclick="decreaseQuantity()">-</button>
                <!-- quantity logic for when the product is entered the quantity table is relative to quantity value -->
                <span id="quantity-value">1</span> 
                <button class="qty-btn" onclick="increaseQuantity()">+</button>
            </div>
        </div>

        
        </div>
        <div class="product-table">
          <table>
            <tr class="table-title" id="productTable">
              <td>Name</td>
              <td>Quantity</td>
              <td>Price</td>
              <td>Total</td>
            </tr>
            <tbody id="salesTable">
        <!-- Fetched product details will appear here -->

          </tbody>
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
            <!-- total price -->
            </div>
              Change
            <div class="change">
              <!-- change -->
            </div>
            <div class="checkoutbutton">
              <button class="checkout-btn" onclick="checkout()">Checkout</button>
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

  <script>

    let quantity = 1;

    // Increase quantity
    function increaseQuantity() {
        quantity++;
        document.getElementById("quantity-value").innerText = quantity;
    }

    // Decrease quantity
    function decreaseQuantity() {
        if (quantity > 1) {
            quantity--;
            document.getElementById("quantity-value").innerText = quantity;
        }
    }

    // Handle barcode input and fetch product details
    document.getElementById("barcode").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            let barcode = this.value;
            fetchProduct(barcode, quantity);
            this.value = ""; // Clear input after scanning
        }
    });

    // Fetch product details
    function fetchProduct(barcode, quantity) {
        fetch("functions/fetch_product.php?barcode=" + barcode + "&quantity=" + quantity)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let salesTable = document.getElementById("salesTable");
                    let newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${data.name}</td>
                        <td>${quantity}</td>
                        <td>${data.price}</td>
                        <td>${(data.price * quantity).toFixed(2)}</td>
                    `;
                    salesTable.appendChild(newRow);
                    updateTotal();
                } else {
                    alert("Product not found!");
                }
            });
}

    // Update total price
    function updateTotal() {
        let total = 0;
        document.querySelectorAll("#salesTable tr").forEach(row => {
            let price = parseFloat(row.cells[3].innerText);
            total += price;
        });
        document.querySelector(".price").innerText = "₱" + total.toFixed(2);
    }

    // Handle change calculation
    document.getElementById("cash").addEventListener("input", function() {
        let total = parseFloat(document.querySelector(".price").innerText.replace("₱", "")) || 0;
        let cash = parseFloat(this.value) || 0;
        let change = cash - total;
        document.querySelector(".change").innerText = "₱" + (change >= 0 ? change.toFixed(2) : "0.00");
    });

  </script>




  <!-- checkout button -->
   <script>
    function checkout() {
    let total = parseFloat(document.querySelector(".price").innerText.replace("₱", "")) || 0;
    let cash = parseFloat(document.getElementById("cash").value) || 0;
    
    if (cash < total) {
        alert("Insufficient cash!");
        return;
    }

    let products = [];
    document.querySelectorAll("#salesTable tr").forEach(row => {
        let name = row.cells[0].innerText;
        let quantity = parseInt(row.cells[1].innerText);
        let price = parseFloat(row.cells[2].innerText);
        let totalPrice = parseFloat(row.cells[3].innerText);
        products.push({ name, quantity, price, totalPrice });
    });

    if (products.length === 0) {
        alert("No items to checkout!");
        return;
    }

    fetch("functions/checkout.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ products, total, cash })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Transaction successful!");
            document.getElementById("salesTable").innerHTML = ""; // Clear cart
            document.querySelector(".price").innerText = "₱0.00";
            document.querySelector(".change").innerText = "₱0.00";
            document.getElementById("cash").value = "";
        } else {
            alert("Transaction failed: " + data.message);
        }
    });
}

   </script>
  
</body>
</html>