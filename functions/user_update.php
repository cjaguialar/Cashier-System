<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    if (empty($email) || empty($role)) {
        die("All fields are required.");
    }

    $sql = "UPDATE users SET email=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi",  $email, $role, $id);

    if ($stmt->execute()) {
        header("Location: ../users.php");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
?>
