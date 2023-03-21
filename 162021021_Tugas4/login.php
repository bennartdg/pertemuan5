<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
  header('location: welcome.php');
  exit;
}

if (isset($_POST['login_btn'])) {
  $email = $_POST['user_email'];
  $password = $_POST['user_password'];

  $query = "SELECT * FROM users WHERE user_email = ? AND user_password = ? LIMIT 1";

  $stmt_login = $conn->prepare($query);
  $stmt_login->bind_param('ss', $email, $password);

  if ($stmt_login->execute()) {
    $stmt_login->bind_result($user_id, $user_name, $user_email, $user_password, $user_phone, $user_address, $user_city, $user_photo);
    $stmt_login->store_result();

    if ($stmt_login->num_rows() == 1) {
      $stmt_login->fetch();
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['user_phone'] = $user_phone;
      $_SESSION['user_address'] = $user_address;
      $_SESSION['user_city'] = $user_city;
      $_SESSION['user_photo'] = $user_photo;
      $_SESSION['logged_in'] = true;

      header('location: welcome.php?message=Logged in successfully');
    } else {
      header('location: login.php?error=Cound not verify your account!');
    }
  } else {
    //Error
    header('location: login.php?error=Something went wrong!');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="style/style.css" />
  <link rel="icon" href="assets/mt.jpg" width="120%" height="120%" />
</head>

<body>
  <!-- Container Login -->
  <section>
    <div class="center">
      <div>
        <form autocomplete="off" id="login-form" method="POST" action="login.php">
          <?php if (isset($_GET['error'])) ?>
          <div role="alert">
            <?php if (isset($_GET['error'])) {
              echo $_GET['error'];
            }
            ?>
          </div>
          <div>
            <div>
              <h1>Login</h1>
              <div class="text_field">
                <label>Email</label>
                <span></span>
                <input type="email" name="user_email" autocomplete="new-email" required />
              </div>
              <div class="text_field">
                <label>Password</label>
                <span></span>
                <input type="password" name="user_password" autocomplete="new-password" required />
              </div>
              <div>
                <input type="submit" id="login-btn" name="login_btn" value="Login" />
              </div>
            </div>
          </div>
          <div class="under-button-login">
            Not have account yet?
            <a href="register.html" role="button" class="a-link">Register Here!</a>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Container Login End -->
</body>

</html>