<?php
include 'connect.php';

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    // Checking if the user exists in the database
    $check = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role']; // Save the user role in the session

            // Redirect based on role
            if ($row['role'] == 'admin') {
                header('location: ../admindashboard.php');
            } elseif ($row['role'] == 'cashier') {
                header('location: ../cashierdashboard.php');
            } else {
                echo "Invalid user role!";
            }
        exit();
    } else {
        echo "<script>alert('User does not exist'); window.location.href = '../loginsystem.php';</script>";
    }
}
?>
