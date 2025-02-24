<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    die("Invalid request!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form action="user_update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        <label>Role:</label>
        <select name="role">
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="cashier" <?php if ($user['role'] == 'cashier') echo 'selected'; ?>>Cashier</option>
        </select><br>
        <input type="submit" value="Update User">
    </form>
    <a href="../users.php">Back to Users</a>
</body>
</html>
