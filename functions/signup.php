<?php
include 'connect.php';

if(isset($_POST['signup'])){
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password); // Hashing for security
    $role = $_POST['role'];

    $checkemail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkemail);

    if($result->num_rows > 0){
        // Alert for existing account
        echo "<script>alert('Account already exists!'); window.location.href = '../loginsystem.php';</script>";
        exit();
    }
    else{
        $insertquery = "INSERT INTO users (firstname, lastname, email, password, role)
                        VALUES ('$firstname', '$lastname', '$email', '$password', '$role')";
        if($conn->query($insertquery) === TRUE){
            // Redirect to login page after successful signup
            echo "<script>alert('Signup successful! Please log in.'); window.location.href = '../loginsystem.php';</script>";
            exit();
        }
        else{
            // Alert for database error
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href = '../loginsystem.php';</script>";
        }
    }
}
?>

