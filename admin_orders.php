<?php
// Include your database connection
$conn = mysqli_connect("localhost", "root", "", "flower_db") or die('Connection failed');
session_start();

$message = []; // Initialize the message array

/*-----deleting products from database -----*/
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Delete the order from the database
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('Query failed');

    // Redirect to the orders page
    header('location:admin_orders.php');
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
    <title>Admin Panel</title>
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
            foreach ($message as $message) {
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
<section class="order-container">
    <h1 class="title">Total Orders</h1>
    <div class="box-container"> 
        <?php
        // Query the orders from the database
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
        
        // Fetch and display the orders
        while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
        ?>
            <div class="box">
                <p> User Name:&nbsp<?php echo $fetch_orders['name']; ?></p>
                <p> User ID:&nbsp<?php echo $fetch_orders['user_id']; ?></p>
                <p> placed on:&nbsp<?php echo $fetch_orders['placed_on']; ?></p>
                <p> number:&nbsp<?php echo $fetch_orders['number']; ?></p>
                <p> email:&nbsp<?php echo $fetch_orders['email']; ?></p>
                <p> total price:$ <?php echo $fetch_orders['total_price']; ?>/=</p>
                <p> Method:&nbsp<?php echo $fetch_orders['method']; ?></p>
                <p> Address:&nbsp<?php echo $fetch_orders['address']; ?></p>
                <p> Total Products:&nbsp<?php echo $fetch_orders['total_products']; ?></p>
                 
                 <form method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <select name="update_payment">
                        <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                    </select>
                </form> 
                <form method="post">
                    <a href="admin_orders.php?update=<?php echo $fetch_orders['id']; ?>" class="update" onclick="return confirm('Update this order?')">Update Order</a>
                    <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete" onclick="return confirm('Delete this order?')">Delete</a>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
