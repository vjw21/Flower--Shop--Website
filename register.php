<?php
  include 'connection.php';

  if(isset($_POST['submit-btn'])) {
    // Sanitize and escape user inputs
    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);
  
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
    $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

    // Check if user already exists
    $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('Query Failed');

    if (mysqli_num_rows($select_user) > 0) {
      $message[] = 'User already exists';
    } else {
      // Insert new user
      mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')") or die('Query Failed');
      $message[] = 'Registered Successfully'; 
      header('location:login.php');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>
<body>
<?php
      if(isset($message)){
        foreach ($message as $msg){
          echo '
             <div class="message">
                <span> '.$msg.'</span>
                <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
             </div>';
        }
      }
      ?>
    <section class="form-container">
      <form action="" method="post">
          <h3>Register Now</h3>
          <input type="text" name="name" placeholder="Enter your Name" required>
          <input type="email" name="email" placeholder="Enter your Email" required>
          <input type="password" name="password" placeholder="Enter your password" required>
          <input type="password" name="cpassword" placeholder="Re-enter your password" required>
          <input type="submit" name="submit-btn" class="btn" value="Register Now">
          <p>Already Have An Account? <a href="login.php">Login Now</a></p>
      </form>
    </section>
</body>
</html>
