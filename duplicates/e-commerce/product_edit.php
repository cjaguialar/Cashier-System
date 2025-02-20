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
    <title>edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <table>
        <form action="product_update.php" method="post">
                <?php
                    $barcode = $_GET['bcode'];
                    $sql = "SELECT* FROM tbl_products WHERE barcode= $barcode";
                    $result = $conn->query($sql);

                    $row = array();
                    if($result -> num_rows > 0){
                        $row = $result -> fetch_assoc();
                    }

                ?>
                <tr>
                    <td>Barcode</td>
                    <td>
                        <input type="text" name="id" value="<?php echo $row['id']; ?> " hidden>
                        <input type="text" name="barcode" value="<?php echo $row['barcode']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <input type="text" name="desc" value="<?php echo $row['description']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Unit Price</td>
                    <td>
                        <input type="text" name="uprice" value="<?php echo $row['unit_price']; ?>">
                        
                    </td>
                </tr>
                <tr>
                    <td>Stocks</td>
                    <td>
                        <input type="text" name="stocks" value="<?php echo $row['unit_price']; ?>">  
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="" value="Update"></td>
                </tr>


        </form>
    </table>
</body>
</html>