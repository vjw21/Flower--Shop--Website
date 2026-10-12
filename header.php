<?php
// Start session and establish database connection
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'flower_db'); // Update with your database credentials
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = 0; // Default value if the user is not logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Celestial Floral</title>
</head>
<body>
<header class="header">
    <div class="flex">
        <a href="admin_header.php" class="logo">Celestial &nbsp<span>Floral</span></a>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="orders.php">Orders</a>
            <a href="about.php">About us</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="icons">
            <i class="bi bi-person" id="user-icon"></i>
            <?php
            $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = $user_id") or die('query failed');
            $wishlist_num_rows = mysqli_num_rows($select_wishlist);
            ?>
            <a href="wishlist.php"><i class="bi bi-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = $user_id") or die('query failed');
            $cart_num_rows = mysqli_num_rows($select_cart);
            ?>
            <a href="cart.php"><i class="bi bi-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
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
</body>
</html>
