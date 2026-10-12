<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
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
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php
                $user_id = $_SESSION['user_id'];
                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="wishlist.php"><i class="bi bi-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>

                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="bi bi-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
            <?php else: ?>
                <a href="login.php"><i class="bi bi-heart"></i><span>(0)</span></a>
                <a href="login.php"><i class="bi bi-cart"></i><span>(0)</span></a>
            <?php endif; ?>
            <i class="bi bi-list" id="menu-toggle"></i>
        </div>
    </div>
</header>

<div class="slider-section">
    <div class="slide-show-container">
        <div class="wrapper-one">
            <div class="wrapper-text">About Us</div>
        </div>
        <div class="wrapper-two">
            <div class="wrapper-text"></div>
        </div>
        <div class="wrapper-three">
            <div class="wrapper-text"></div>
        </div>
    </div>
</div>

<div class="about">
    <div class="row">
        <div class="detail">
            <h1>Visit Our Beautiful Showroom</h1>
            <p>Welcome to Celestial Floral, where the beauty of nature meets the art of floristry! Founded with a passion for flowers and a commitment to delivering joy, we specialize in creating stunning floral arrangements for every occasion. Whether it’s a wedding, birthday, anniversary, or just because, our talented florists carefully handcraft each bouquet using the freshest blooms to ensure they bring happiness and warmth to your loved ones.</p>
            <a href="shop.php" class="btn2">Shop Now</a>
        </div>
        <div class="img-box">
            <img src="image/about3.png">
        </div>
    </div>
</div>

<div class="banner-2">
    <h1>Let Us make Your Wedding Flawless</h1>
    <a href="shop.php" class="btn2">Shop Now</a>
</div>

<div class="services">
    <h1 class="title">Our Services</h1>
    <div class="box-container">
        <div class="box">
            <i class="bi bi-percent"></i>
            <h3>20% OFF + FREE SHIPPING</h3>
            <p>Starting at $40 for a month. Plus, get $130 points on regular orders.</p>
        </div>
        <div class="box">
            <i class="bi bi-asterisk"></i>
            <h3>FRESHEST BLOOMS</h3>
            <p>Starting at $40 for a month. Plus, get $130 points on regular orders.</p>
        </div>
        <div class="box">
            <i class="bi bi-alarm"></i>
            <h3>SUPER FLEXIBLE</h3>
            <p>Customize recipient, date, or flowers. Skip or cancel anytime.</p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
