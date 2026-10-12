<?php

include 'connection.php';

// Get user ID if logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


/*----- Adding products to cart --------*/
/*----- update products to cart --------*/
if (isset($_POST['update_quantity_btn'])){
    $update_quantity_id = $_POST['update_quantity_id'];
    $update_value = $_POST['update_quantity'];

    $update_query = mysqli_query($conn , "UPDATE `cart` SET quantity='$update_value' WHERE id='$update_quantity_id'")or die('query failed');
    if ($update_query){
        header('location:cart.php');  

    }
}

     /*----deleting products from wishlist-----*/    
     if (isset($_GET['delete'])) {
     $delete_id = $_GET['delete'];

    // Delete the specific item from the wishlist
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('Query failed');

    // Redirect to the wishlist page
    header('location:cart.php');
    exit();
}


if (isset($_GET['delete_all'])) {
    // Delete all wishlist items for the current user
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');

    
    header('location:cart.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="wishlist.php"><i class="bi bi-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="bi bi-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
                <i class="bi bi-list" id="menu-toggle"></i>
        </div>
        
    </div>
</header>

<div class="slider-section">
    <div class="slide-show-container">
        <div class="wrapper-one">
            <div class="wrapper-text">My Wishlist</div>
        </div>
        <div class="wrapper-two">
            <div class="wrapper-text"></div>
        </div>
        <div class="wrapper-three">
            <div class="wrapper-text"></div>
        </div>
    </div>
</div>
  <div class="shop">
    <h1 class="title">Products added in wishlist</h1>
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
    <div class="box-container">
    <?php
    $grand_total = 0;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id' ") or die('query failed');
    if(mysqli_num_rows($select_cart) > 0) {
        while($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            // Ensure the price and quantity are numeric before performing operations
            $price = floatval($fetch_cart['price']);
            $quantity = intval($fetch_cart['quantity']);
            $total_amt = $price * $quantity;
    ?>
            <div class="box">
                <div class="icon">
                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x"></a>
                    <a href="view_page.php?pid=<?php echo htmlspecialchars($fetch_cart['id']); ?>" class="bi bi-eye-fill"></a>
                </div>
                <img src="image/<?php echo htmlspecialchars($fetch_cart['image']); ?>">
                <div class="price">$<?php echo htmlspecialchars($price); ?>/-</div>
                <div class="name"><?php echo htmlspecialchars($fetch_cart['name']); ?></div>
                <form method="post">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id'] ?>">
                    <div class="qty">
                        <input type="number" min="1" name="update_quantity" value="<?php echo $quantity; ?>">
                        <input type="submit" name="update_quantity_btn" value="update">
                    </div>
                </form>
                <div class="total-amt">
                    Total Amount: <span><?php echo $total_amt; ?></span>
                </div>
            </div>
    <?php
            $grand_total += $total_amt;
        }
    } else {
        echo '<img src="image/empty2.jpg">';
    }
    ?>
</div>
<div class="dlt">
    <a href="cart.php?delete_all" class="btn2"> delete all</a>
</div>
<div class="wishlist_total">

        <p>Total amount payable : <span>$<?php echo $grand_total ?> /- </span></p>
        <a href="shop.php" class="btn2">Continue shopping</a>&nbsp &nbsp
        <a href="wishlist.php?delete_all" class="btn2" 
   <?php echo ($grand_total > 1) ? '' : 'disabled'; ?> 
   onclick="return confirm('Do you want to delete all from wishlist?')">
   Proceed to check out
</a>

      </div>
    
   </div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
