<?php
include 'connect.php';

// Fetch daily sales (last 7 days)
$sql_daily = "SELECT sale_date, SUM(total_amount) AS total_sales 
              FROM sales 
              WHERE sale_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
              GROUP BY sale_date ORDER BY sale_date ASC";
$result_daily = $conn->query($sql_daily);

$dates = [];
$sales = [];
while ($row = $result_daily->fetch_assoc()) {
    $dates[] = $row['sale_date'];
    $sales[] = $row['total_sales'];
}

// Fetch weekly sales (grouped by day of the week)
$sql_weekly = "SELECT DAYNAME(sale_date) AS sale_day, SUM(total_amount) AS total_sales 
               FROM sales 
               WHERE sale_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
               GROUP BY sale_day 
               ORDER BY FIELD(sale_day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')";
$result_weekly = $conn->query($sql_weekly);

$days = [];
$weekly_sales = [];
while ($row = $result_weekly->fetch_assoc()) {
    $days[] = $row['sale_day'];
    $weekly_sales[] = $row['total_sales'];
}

// Fetch all sales for the table
$salesData = $conn->query("SELECT * FROM sales ORDER BY sale_date DESC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="styles/cashierstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <h2>Sales Report</h2>
    <!-- Buttons for Generating Charts -->
    <button onclick="generateChart('daily')">Generate Daily Sales</button>
    <button onclick="generateChart('weekly')">Generate Weekly Sales</button>

    <!-- Chart -->
    <canvas id="salesChart" width="150" height="50"></canvas> 

    <!-- Sales Table -->
    <table>
        <tr>
            <th>ID</th> <th>Total</th> <th>Cash</th> <th>Change</th> <th>Date</th> <th>Action</th>
        </tr>
        <?php while ($row = $salesData->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td>₱<?= number_format($row['total_amount'], 2) ?></td>
            <td>₱<?= number_format($row['cash_given'], 2) ?></td>
            <td>₱<?= number_format($row['change_amount'], 2) ?></td>
            <td><?= $row['sale_date'] ?></td>
            <td><a href="receipt.php?sale_id=<?= $row['id'] ?>" target="_blank">View</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
var salesChart; // Store the chart instance globally

function generateChart(type) {
    var ctx = document.getElementById('salesChart').getContext('2d');
    var chartType = type === 'daily' ? 'line' : 'bar';

    var labels = type === 'daily' ? <?= json_encode($dates) ?> : <?= json_encode($days) ?>;
    var data = type === 'daily' ? <?= json_encode($sales) ?> : <?= json_encode($weekly_sales) ?>;

    // Destroy previous chart if it exists
    if (salesChart) {
        salesChart.destroy();
    }

    // Create new chart
    salesChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: labels,
            datasets: [{
                label: type === 'daily' ? 'Daily Sales (₱)' : 'Weekly Sales (₱)',
                data: data,
                backgroundColor: type === 'daily' ? 'rgba(54, 162, 235, 0.5)' : 'rgba(255, 99, 132, 0.5)',
                borderColor: type === 'daily' ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
}
</script>

</body>
</html>
