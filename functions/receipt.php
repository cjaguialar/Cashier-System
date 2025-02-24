<?php
include 'connect.php';

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (!isset($_GET['sale_id'])) {
    die("Invalid request!");
}

$sale_id = $_GET['sale_id'];

// Fetch sale details
$sql = "SELECT * FROM sales WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sale_id);
$stmt->execute();
$sale = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch sold items
$sql = "SELECT p.name, sd.quantity, sd.price, sd.total_price 
        FROM sale_details sd 
        JOIN products p ON sd.product_id = p.id 
        WHERE sd.sale_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sale_id);
$stmt->execute();
$sold_items = $stmt->get_result();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .receipt { width: 300px; margin: auto; padding: 20px; border: 1px solid black; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border-bottom: 1px solid black; padding: 5px; text-align: left; }
        .btn { margin-top: 10px; padding: 10px; background: blue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div>
<div class="receipt" style="margin-top: 80px;">
    <h3>Receipt</h3>
    <p>Sale ID: <?= $sale['id'] ?></p>
    <p>Date: <?= $sale['sale_date'] ?></p>

    <table>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php while ($item = $sold_items->fetch_assoc()) { ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>₱<?= number_format($item['price'], 2) ?></td>
            <td>₱<?= number_format($item['total_price'], 2) ?></td>
        </tr>
        <?php } ?>
    </table>

    <h4>Total: ₱<?= number_format($sale['total_amount'], 2) ?></h4>
    <p>Cash Given: ₱<?= number_format($sale['cash_given'], 2) ?></p>
    <p>Change: ₱<?= number_format($sale['change_amount'], 2) ?></p>

    <button class="btn" onclick="window.print()">Print</button>
</div>
</div>
</body>
</html>
