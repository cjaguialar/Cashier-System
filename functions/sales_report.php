<?php

include 'connect.php';

// Fetch all sales
$sql = "SELECT * FROM sales ORDER BY sale_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="styles/cashierstyle.css">
</head>
<body>

<div class="container">
    <h2>Sales Report</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Total Amount</th>
            <th>Cash Given</th>
            <th>Change</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td>₱<?= number_format($row['total_amount'], 2) ?></td>
            <td>₱<?= number_format($row['cash_given'], 2) ?></td>
            <td>₱<?= number_format($row['change_amount'], 2) ?></td>
            <td><?= $row['sale_date'] ?></td>
            <td>
                <a href="receipt.php?sale_id=<?= $row['id'] ?>" target="_blank">View Receipt</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
