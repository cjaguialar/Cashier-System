<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../users.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    die("Invalid request!");
}
?>
