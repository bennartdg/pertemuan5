<?php
include('server/connection.php');
session_start();

$id = $_GET['user_id'];

$q = "SELECT * FROM users WHERE user_id = $id";

$result = mysqli_query($conn, $q);

$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit_btn'])) {
  $username = $_POST['user_name'];
  $email = $_POST['user_email'];
  $password = $_POST['user_password'];

  $query = "UPDATE users SET 
  user_name = '$username', 
  user_email = '$email', 
  user_password = '$password' 
  WHERE user_id = '$id'";

  mysqli_query($conn, $query);

  header('location: welcome.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modify</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="icon" href="assets/mt.jpg" width="120%" height="120%" />
</head>

<body>
  <div class="center">
    <div class="text_field">
      <form action="" method="POST">
        <div>
          <div>
            <h1>Modify Data</h1>
            <div class="text_field">
              <label>New Username</label>
              <span></span>
              <input placeholder="Current: <?php echo $row['user_name'] ?>" type="text" name="user_name" autocomplete="off" required />
            </div>
            <div class="text_field">
              <label>New Email</label>
              <span></span>
              <input placeholder="Current: <?php echo $row['user_email'] ?>" type="email" name="user_email" autocomplete="new-email" required />
            </div>
            <div class="text_field">
              <label>New Password</label>
              <span></span>
              <input type="password" name="user_password" autocomplete="new-password" required />
            </div>
            <div>
              <input type="submit" id="submit-btn" name="submit_btn" value="Submit" />
            </div>
          </div>
          <div class="under-button-register">
            <a href="welcome.php" role="button" class="a-link">Back</a>
          </div>
      </form>
    </div>
  </div>
</body>

</html>