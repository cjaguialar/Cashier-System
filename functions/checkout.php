    <?php
    include 'connect.php';

    if ($conn->connect_error) {
        die(json_encode(["success" => false, "message" => "Database connection failed"]));
    }

    $data = json_decode(file_get_contents("php://input"), true);
    $products = $data['products'];
    $total = $data['total'];
    $cash = $data['cash'];
    $change = $cash - $total;

    // Insert into sales table
    $sql = "INSERT INTO sales (total_amount, cash_given, change_amount) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddd", $total, $cash, $change);
    $stmt->execute();
    $sale_id = $stmt->insert_id;
    $stmt->close();

    // Insert sale details & update stock
    foreach ($products as $product) {
        $name = $product['name'];
        $quantity = $product['quantity'];
        $price = $product['price'];
        $totalPrice = $product['totalPrice'];

        // Get product ID
        $stmt = $conn->prepare("SELECT id FROM products WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $product_id = $result->fetch_assoc()['id'];
        $stmt->close();

        // Insert sale details
        $stmt = $conn->prepare("INSERT INTO sale_details (sale_id, product_id, quantity, price, total_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiidd", $sale_id, $product_id, $quantity, $price, $totalPrice);
        $stmt->execute();
        $stmt->close();

        // Update product stock
        $stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $product_id);
        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    echo json_encode([
        "success" => true,
        "receipt_url" => "functions/receipt.php?sale_id=" . $sale_id
    ]);
    ?>
