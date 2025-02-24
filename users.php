<?php 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Users</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="styles/adminstyle.css">
</head>
<body>
  <div class="sidebar">

    <div class="profile">
      <div class="profile-icon"><ion-icon name="person-outline"></ion-icon></div>
      <div class="profile-name">Sherwin Angelo Ortega</div>
    </div>

    <ul>
      <li class="icon">
        <a href="admindashboard.php">
          <ion-icon name="cart-outline"></ion-icon>
          <p>Products</p></a>
      </li>
    </ul>

    <ul>
      <li class="icon">
        <a href="#">
          <ion-icon name="people-outline"></ion-icon>
          <p>Users</p></a>
      </li>
    </ul>

    <ul>
      <li class="icon">
        <a href="#">
          <ion-icon name="newspaper-outline"></ion-icon>
          <p>Sales</p></a>
      </li>
    </ul>

    <ul>
      <li class="icon">
        <a href="cashierdashboard.php">
          <ion-icon name="cash-outline"></ion-icon>
          <p>Cashier</p></a>
      </li>
    </ul>

    <ul>
      <li class="logout">
        <a href="loginsystem.php">
          <ion-icon name="log-out-outline"></ion-icon>
          <p>Log Out</p></a>
      </li>
    </ul>
  </div>

  <div class="categories-header">
    <nav class="navbar">
      <div><a data-tab-target="#cashiers">
        Cashiers</a></div>
      <div><a data-tab-target="#admins">
        Admins</a></div>
    </nav>
  </div>

  <div class="tab-content">
    <div id="cashiers" data-tab-content class="active">
      <p class="tab-header">
        Cashiers
      </p>
      <table>
        <tr class="table-title">
          <td>First Name</td>
          <td>Last Name</td>
          <td>Email</td>
          <td>Role</td>
          <td>Actions</td>
        </tr>
        <?php
include 'functions/connect.php';
$sql = "SELECT * FROM users WHERE role = 'cashier'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<tr>
  <td><?php echo htmlspecialchars($row['firstname']); ?></td>
  <td><?php echo htmlspecialchars($row['lastname']); ?></td>
  <td><?php echo htmlspecialchars($row['email']); ?></td>
  <td><?php echo htmlspecialchars($row['role']); ?></td>
  <td class="action-container">
    <a href="functions/user_edit.php?id=<?php echo $row['id']; ?>" class="actions">Edit</a>
    <a href="functions/user_delete.php?id=<?php echo $row['id']; ?>" class="actions" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
  </td>
</tr>
<?php
    }
} else {
    echo "<tr><td colspan='5'>No cashiers found.</td></tr>";
}
?>

      </table>
    </div>

    <div id="admins" data-tab-content>
      <p class="tab-header">
        Cashiers
      </p>
      <table>
        <tr class="table-title">
          <td>First Name</td>
          <td>Last Name</td>
          <td>Username</td>
          <td>Role</td>
          <td>Actions</td>
        </tr>
        <?php
        include 'functions/connect.php';
$sql = "SELECT * FROM users WHERE role = 'admin'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<tr>
  <td><?php echo htmlspecialchars($row['firstname']); ?></td>
  <td><?php echo htmlspecialchars($row['lastname']); ?></td>
  <td><?php echo htmlspecialchars($row['email']); ?></td>
  <td><?php echo htmlspecialchars($row['role']); ?></td>
  <td class="action-container">
    <a href="functions/user_edit.php?id=<?php echo $row['id']; ?>" class="actions">Edit</a>
    <a href="functions/user_delete.php?id=<?php echo $row['id']; ?>" class="actions" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
  </td>
</tr>
<?php
    }
} else {
    echo "<tr><td colspan='5'>No admins found.</td></tr>";
}
?>

      </table>
    </div>
  </div>

  <script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
  ></script>
  <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
  ></script>

  <script>
    const tags = document.querySelectorAll('[data-tab-target]');
    const tabContents = document.querySelectorAll('[data-tab-content]');

    tags.forEach(tag => {
        tag.addEventListener('click', (event) => {
            event.preventDefault(); 

            const targetId = tag.dataset.tabTarget;
            const target = document.querySelector(targetId);

            if (!target) return; 

            
            tabContents.forEach(tabContent => {
                tabContent.classList.remove('active');
            });

            
            target.classList.add('active');
        });
    });
</script>
</body>
</html>