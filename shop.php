<?php

include 'connection.php';

// Get user ID if logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

/*----- Adding products to wishlist --------*/
if (isset($_POST['add_to_wishlist'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    // Query to check if the product already exists in the wishlist
    $cart_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id='$user_id'") or die('Query failed');

    // Check if the product is already in the wishlist
    if(mysqli_num_rows($cart_number) > 0) {
        $message[] = 'Product already exists in wishlist';
    } else {
        // Insert the product into the wishlist
        mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`, `pid`, `name`, `price`, `image`) 
VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") 
or die('Insert query failed');

        $message[] = 'Product successfully added to wishlist';
    }
}



/*----- Adding products to cart --------*/
if (isset($_POST['add_to_cart'])) {
   
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $cart_number = mysqli_query($conn , "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id='$user_id'") or die('query failed');
        if(mysqli_num_rows($cart_number)>0){
            $message[] = 'product already exist in cart';
        }else{
            mysqli_query($conn, "INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`image`)VALUES('$user_id','$product_id','$product_name','$product_price','$product_image')");
            $message[] ='product successfully added in cart';
        }
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
            <div class="wrapper-text">Our Shop</div>
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
    <h1 class="title">Shop Best Sellers</h1>
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
        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
        if(mysqli_num_rows($select_products) > 0) {
            while($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
            <form action="" method="post" class="box">
                <img src="image/<?php echo htmlspecialchars($fetch_products['image']); ?>">
                <div class="price">$<?php echo htmlspecialchars($fetch_products['price']); ?>/-</div>
                <div class="name"><?php echo htmlspecialchars($fetch_products['name']); ?></div>
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($fetch_products['id']); ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']); ?>">
                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']); ?>">
                <input type="hidden" name="product_quantity" value="1" min="0">
                <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']); ?>">
                <div class="icon">
                    <a href="view_page.php?pid=<?php echo htmlspecialchars($fetch_products['id']); ?>" class="bi bi-eye-fill"></a>
                    <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                    <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                </div>  
            </form>
        <?php
            }
        } else {
            echo '<p class="empty">No Products Added Yet!</p>';
        }
        ?>
    </div>
    <div class="more">
       <a href="shop.php">Load More</a> 
       <i class="bi bi-arrow-down"></i>
    </div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
