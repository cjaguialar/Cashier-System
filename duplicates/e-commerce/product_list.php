<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pos_db";

    $conn = new mysqli($server, $username, $password, $database);

    if($conn ->connect_error){
        die("connection error" . $conn->connect_error);
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>E-commerce</title>
</head>
<body>
    <h2>List of products</h2>
    <h4><?php echo isset($_GET['message']) ? $_GET['message']: ' ' ; ?></h4>
    <a href="product_new.php">New Product</a>
    <table border="1" width="50%">
            <tr>
                <td>Barcode</td>
                <td>Description</td>
                <td>Unit Price</td>
                <td>Stocks</td>
                <td>Actions</td>
            </tr>
                <?php
                    $sql = "SELECT * FROM tbl_products ORDER BY `description` ";
                    $result = $conn->query($sql);
                    echo '<br>';
                    if($result->num_rows >0){
                        while($row = $result->fetch_assoc()){

                ?>
            <tr>
                <td><?php echo $row['barcode']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['unit_price']; ?></td>
                <td><?php echo $row['stocks']; ?></td>
                <td>
                    <a href="product_edit.php?bcode=<?php 
                    echo $row['barcode']; ?>">Edit</a>
                    <a href="product_delete.php?bcode=<?php 
                     echo $row['barcode']; ?>">Delete</a>
                </td>
            </tr>
            <?PHP
                    }
                } //end of while
            ?>
    </table>

    
</body>
</html>