<?php
 include 'connection.php';


 $admin_id = $_SESSION['admin_id'];
 if (!isset($admin_id)) {
    header('location:admin_header.php');
    exit();
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin Panel</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="admin.php" class="logo">Admin<span>Panel</span></a>
            <nav class="navbar">
                <a href="admin.php">Home</a>
                <a href="admin_product.php">Products</a>
                <a href="admin_orders.php">Orders</a>
                <a href="admin_user.php">Users</a>
                <a href="admin_message.php">Message</a>
           </nav>
           <div class="icons">
            <i class="bi bi-person" id="user-icon"></i>
            <i class="bi bi-list" id="menu-toggle"></i>
           </div>

            <div class="user-box">
                <?php if (isset($_SESSION['admin_name']) && isset($_SESSION['admin_email'])): ?>
                    <p>Username: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                    <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <?php else: ?>
                    <p>No user logged in.</p>
                <?php endif; ?>

                <form method="post">
                    <button name="logout" class="logout-btn">LOG OUT</button>
                </form>
            </div>
        </div>
    </header>
    <section class="dashboard">
        <h1 class="title">Dashboard</h1>
        <div class="box-container">
            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'");
                if ($select_pendings) {
                    while ($fetch_pending = mysqli_fetch_assoc($select_pendings)) {
                        $total_pendings += $fetch_pending['total_price'];
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
                <h3>$ <?php echo $total_pendings; ?></h3>
                <p>Total pending</p>
            </div>
            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed'");
                if ($select_completed) {
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                        $total_completed += $fetch_completed['total_price'];
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
                <h3>$ <?php echo $total_completed; ?></h3>
                <p>Total completed</p>
            </div>
            <div class="box">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed: ' . mysqli_error($conn));
                $num_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3><?php echo $num_of_orders; ?></h3>
                <p>Orders placed</p>
            </div>
            <div class="box">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed: ' . mysqli_error($conn));
                $num_of_products = mysqli_num_rows($select_products);
                ?>
                <h3><?php echo $num_of_products; ?></h3>
                <p>Products added</p>
            </div>
            <div class="box">
                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('Query failed: ' . mysqli_error($conn));
                $num_of_users = mysqli_num_rows($select_users);
                ?>
                <h3><?php echo $num_of_users; ?></h3>
                <p>Registered Users</p>
            </div>
            <div class="box">
                <?php
                $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('Query failed: ' . mysqli_error($conn));
                $num_of_admins = mysqli_num_rows($select_admins);
                ?>
                <h3><?php echo $num_of_admins; ?></h3>
                <p>Total Admins</p>
            </div>
            <div class="box">
                <?php
                $select_total_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('Query failed: ' . mysqli_error($conn));
                $num_of_total_users = mysqli_num_rows($select_total_users);
                ?>
                <h3><?php echo $num_of_total_users; ?></h3>
                <p>Total users</p>
            </div>
            <div class="box">
                <?php
                $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('Query failed: ' . mysqli_error($conn));
                $num_of_message = mysqli_num_rows($select_message);
                ?>
                <h3><?php echo $num_of_message; ?></h3>
                <p>New Message</p>
           
            </div>    
        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
