<?php
session_start();
include 'connection.php'; // Ensure this line is included to define $conn

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

/*-----adding products to database------*/
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'image/' . $image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name'") or die('query failed');
    
    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product name already exists';
    } else {
        if ($image_size > 2000000) {
            $message[] = 'Product image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product_detail`, `image`) 
              VALUES('$product_name', '$product_price', '$product_detail', '$image')") or die('query failed');
            
            if ($insert_product) {
                $message[] = 'Product added successfully';
            } else {
                $message[] = 'Failed to add product';
            }
        }
    }
}

/*-----deleting products from database -----*/
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete']; 
    $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = $delete_id") or die('query failed');

    if (mysqli_num_rows($select_delete_image) > 0) {
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        if (!empty($fetch_delete_image['image']) && file_exists('image/' . $fetch_delete_image['image'])) {
            unlink('image/' . $fetch_delete_image['image']); // Delete the image file
        }
    }

    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed'); 

    header('location:admin_product.php');
    exit();
}

/*-----updating product in the database-----*/
if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = mysqli_real_escape_string($conn, $_POST['update_p_name']);
    $update_p_price = mysqli_real_escape_string($conn, $_POST['update_p_price']);
    $update_p_detail = mysqli_real_escape_string($conn, $_POST['update_p_detail']);
    $update_p_img = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'image/' . $update_p_img;

    // Update product information
    $update_query = "UPDATE `products` SET name='$update_p_name', price='$update_p_price', product_detail='$update_p_detail'";
    
    // Only update image if a new one was uploaded
    if (!empty($update_p_img)) {
        $update_query .= ", image='$update_p_img'";
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
    }
    
    $update_query .= " WHERE id='$update_p_id'";
    
    $run_update_query = mysqli_query($conn, $update_query) or die('query failed');

    if ($run_update_query) {
        $message[] = 'Product updated successfully';
        header('Location: admin_product.php'); // Prevent form resubmission
        exit();
    } else {
        $message[] = 'Product could not be updated successfully';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin Product</title>
    <style>
        .update-container {
            display: none;
            /* You can adjust this section to make it look better when shown */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 2px solid #ddd;
            z-index: 10;
        }
        .update-container form{
              width: 50vw;
              margin: 2rem auto;
              background: #f3cece;
              padding: 1rem 2rem;
              border-radius:5px;
              border: 1px solid #fef0ea;
}
         .update-container{
            background-image: url('image/bg.jpg');
         }

        .show {
            display: block !important;
        }

        .input-field {
            margin-bottom: 15px;
        }
    </style>
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

<section class="add-products">
    <form method="post" enctype="multipart/form-data">
        <h1>Add New Product</h1>
        <div class="input-field">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" required>
        </div> 
        <div class="input-field">
            <label for="price">Product Price</label>
            <input type="text" id="price" name="price" required>
        </div> 
        <div class="input-field">
            <label for="detail">Product Detail</label>
            <textarea id="detail" name="detail" required></textarea>
        </div> 
        <div class="input-field">
            <label for="image">Product Image</label>
            <input type="file" id="image" name="image" accept="image/jpg, image/png, image/jpeg, image/webp" required>
        </div> 
        <input type="submit" name="add_product" value="Add Product" class="btn">
    </form>
</section>

<section class="show-products">
    <div class="box-container">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
        <div class="box">
            <img src="image/<?php echo htmlspecialchars($fetch_products['image']); ?>" alt="Product Image">
            <p>Price: $<?php echo htmlspecialchars($fetch_products['price']); ?></p>
            <h4><?php echo htmlspecialchars($fetch_products['name']); ?></h4>
            <p class="detail"><?php echo htmlspecialchars($fetch_products['product_detail']); ?></p>
            <a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit-btn">Edit</a>
            <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
        </div>
        <?php
            }
        }
        ?>
    </div>
</section>

<section class="update-container <?php echo isset($_GET['edit']) ? 'show' : ''; ?>">
    <?php
    if (isset($_GET['edit'])) {
        $edit_id = $_GET['edit'];
        $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id") or die('query failed');
        if (mysqli_num_rows($edit_query) > 0) {
            while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
    ?>
    <form method="post" enctype="multipart/form-data">
        <img src="image/<?php echo htmlspecialchars($fetch_edit['image']); ?>" alt="Product Image">
        <input type="hidden" name="update_p_id" value="<?php echo htmlspecialchars($fetch_edit['id']); ?>">
        <input type="text" name="update_p_name" value="<?php echo htmlspecialchars($fetch_edit['name']); ?>">
        <input type="number" min="0" name="update_p_price" value="<?php echo htmlspecialchars($fetch_edit['price']); ?>">
        <textarea name="update_p_detail"><?php echo htmlspecialchars($fetch_edit['product_detail']); ?></textarea>
        <input type="file" name="update_p_image" accept="image/png,image/jpg,image/jpeg,image/webp">
        <input type="submit" name="update_product" value="Update" class="edit">
        <input type="reset" value="Cancel" class="option-btn btn" id="close-edit">
    </form>
    <?php   
            }
        }
    }
    ?>
</section>

<script type="text/javascript" src="script.js"></script>
<script>
// Add functionality to close the edit form
document.getElementById('close-edit').addEventListener('click', function() {
    document.querySelector('.update-container').style.display = 'none';
});
</script>

</body>
</html>
