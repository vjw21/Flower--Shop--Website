<?php
 include 'connection.php';
 session_start();

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
    <title>Admin Panel</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <section class="dashboard">
        
        <div class="box-container">
            <div class="box">
                <?php
                $total_pending = 0;
                $select_pending = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'");
                while ($fetch_pending = mysqli_fetch_assoc($select_pending)) {
                    $total_pending += $fetch_pending['total_price'];
                }
                ?>
                
            
        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
