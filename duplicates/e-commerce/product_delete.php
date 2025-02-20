<?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pos_db";

    $conn = new mysqli($server, $username, $password, $database);

    if($conn ->connect_error){
        die("connection error" . $conn->connect_error);
    }
    $barcode = $_GET['bcode'];
    $barcode = $conn->real_escape_string($barcode);

    // logic delete
    $sql = "DELETE FROM tbl_products WHERE barcode= '$barcode'";
        if($conn->query($sql) === TRUE){
            $msg = 'Product deleted';
            header('location: product_list.php?message='.$msg);
        }else{
            echo "echo deleting record " .$conn->error;
        }
        $conn ->close();
?>