<?php
// Include your database connection
$conn = mysqli_connect("localhost", "root", "", "flower_db") or die('Connection failed');
session_start();

$message = []; // Initialize the message array

/*-----deleting products from database -----*/
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Delete the order from the database
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('Query failed');

    // Redirect to the orders page
    header('location:admin_message.php');
    exit();
}

/*update order detail---*/
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    mysqli_query($conn, "UPDATE `orders` SET payment_status='$update_payment' WHERE id='$order_id'") or die('Query failed');
    $message[] = 'Payment status updated successfully'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin User Panel</title>
</head>
<body>
<header class="header">
    <div class="flex">
        <a href="admin_header.php" class="logo">Admin<span>Panel</span></a>
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
        <?php 
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '
                    <div class="message">
                        <span>' . htmlspecialchars($msg) . '</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>';
            }
        }
        ?>
    </div>
</header>

<section class="user-container">
    <h1 class="title">Client's Messages</h1>
    <div class="box-container">
    <?php
        // Query the messages from the database
        $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('Query failed');

        // Check if there are any messages
        if (mysqli_num_rows($select_message) > 0) {
            // Fetch and display the messages
            while ($fetch_message = mysqli_fetch_assoc($select_message)) {
        ?>
        <div class="box">
          <p>user id: <span><?php echo $fetch_message['user_id']; ?></span></p>
          <p>user Name: <span><?php echo $fetch_message['name']; ?></span></p>
          <p>Email: <span style="color:<?php if ($fetch_message['email'] == 'admin') {echo 'orange';}; ?>">
          <?php echo $fetch_message['email']; ?></span></p>
          <p>Message: <span><?php echo $fetch_message['message']; ?></span></p>
          <p><a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" class="delete" onclick="return confirm('Delete this')">Delete</a></p>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">No Message Yet</p>';
        }
    ?>
    </div>
</section>

<script type="text/javascript" src="script.js"></script>
</body>
</html>
