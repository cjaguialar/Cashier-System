<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pos_db";

    $conn = new mysqli($server, $username, $password, $database);

    if($conn ->connect_error){
        die("connection error" . $conn->connect_error);
    }


    $id =$_POST['id'];
    $barcode = $_POST['barcode'];
    $description = $_POST['desc'];
    $price = $_POST['uprice'];
    $stocks = $_POST['stocks'];

    $sql = "UPDATE tbl_products SET barcode = '$barcode', `description` ='$description', unit_price ='$price',
     stocks = '$stocks' where id = '$id'";


    if($conn->query($sql)===TRUE){
        $msg = "product updated" ;
        header('location: product_list.php?message='.$msg);
    }else {
        echo "error: ". $sql. " <br>".$conn->error;
    }
    $conn->close();

?>