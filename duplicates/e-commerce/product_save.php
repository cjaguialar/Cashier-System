<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pos_db";

    $conn = new mysqli($server, $username, $password, $database);

    if($conn ->connect_error){
        die("connection error" . $conn->connect_error);
    }

    $code = $_POST['barcode'];
    $description = $_POST['desc'];
    $price = $_POST['uprice'];
    $stocks = $_POST['stocks'];

    $sql = "INSERT INTO tbl_products (barcode, `description`, unit_price, stocks) 
    VALUES ('$code', '$description', '$price', '$stocks')";

    if($conn->query($sql) === TRUE) {
        $msg = "New product registered successfully created";
        header('location: product_list.php?message='.$msg);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



    $conn->close();

?>
