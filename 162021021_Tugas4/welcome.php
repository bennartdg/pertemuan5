<?php
include('server/connection.php');
session_start();

if (isset($_POST['cari'])) {
  $keyword = $_POST['keyword'];
  $q = "SELECT * from users WHERE user_id LIKE '%$keyword%' or
    user_name LIKE '%$keyword%' or user_email LIKE '%$keyword%'";
} else {
  $q = 'SELECT * FROM users';
}
$result = mysqli_query($conn, $q);

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_phone = $_SESSION['user_phone'];
$user_address = $_SESSION['user_address'];
$user_city = $_SESSION['user_city'];
$user_photo = $_SESSION['user_photo'];

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    header('location: login.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="icon" href="assets/mt.jpg" />
  <link rel="stylesheet" href="assets/topo.jpg">
</head>

<body style="overflow: auto;">
  <div class="center">
    <div>
      <h1>
        Welcome, <?php echo $user_name ?>!
      </h1>
    </div>
    <div class="container-profile">
      <h2 align="center">Your Profile</h2>
      <div align="center">
        <table>
          <tr>
            <th rowspan="7" class="img-td">
              <img src="assets/mt.jpg" alt="" width="150px" style="border-radius: 100%;">
            </th>
          </tr>
          <tr>
            <th type="subject">UserId</th>
            <th>:</th>
            <td><?php echo $user_id ?></td>
          </tr>
          <tr>
            <th type="subject">Name</th>
            <th>:</th>
            <td><?php echo $user_name ?></td>
          </tr>
          <tr>
            <th type="subject">Email</th>
            <th>:</th>
            <td><?php echo $user_email ?></td>
          </tr>
          <tr>
            <th type="subject">Phone</th>
            <th>:</th>
            <td><?php echo $user_phone ?></td>
          </tr>
          <tr>
            <th type="subject">Address</th>
            <th>:</th>
            <td><?php echo $user_address ?></td>
          </tr>
          <tr>
            <th type="subject">City</th>
            <th>:</th>
            <td><?php echo $user_city ?></td>
          </tr>
        </table>
      </div>
    </div>
    <h1>Manage Data</h1>
    <div>
      <div>
        <form action="" method="POST">
          <div class="text_field">
            <input type="text" name="keyword" placeholder="Insert Keyword">
            <div class="btn-cari-position">
              <button class="btn-cari" name="cari">Search</button>
            </div>
          </div>
        </form>
        <table>
          <thead>
            <tr>
              <th style="border-bottom: 2px solid white" scope="col">ID</th>
              <th style="border-bottom: 2px solid white" scope="col">Username</th>
              <th style="border-bottom: 2px solid white" scope="col">Email</th>
              <th style="border-bottom: 2px solid white" scope="col" colspan="2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td style="border-bottom: 1px solid white"><?php echo $row['user_id'] ?></td>
                <td style="border-bottom: 1px solid white"><?php echo $row['user_name'] ?></td>
                <td style="border-bottom: 1px solid white"><?php echo $row['user_email'] ?></td>
                <td style="border-bottom: 1px solid white">
                  <a class="a-delete" href="actionDelete.php?user_id=<?php echo $row['user_id']; ?>" role="button" onclick="return confirm('This Data will be Deleted?')">Delete</a>
                </td>
                <td style="border-bottom: 1px solid white">
                  <a class="a-delete" href="modify.php?user_id=<?php echo $row['user_id']; ?>" role="button">Modify</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <div style="margin-top: 50px;">
          <a href=" welcome.php?logout=1" id="logout-btn">
            <button class="btn-primary">
              Logout
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>