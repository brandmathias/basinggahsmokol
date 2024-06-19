<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// file koneksi
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['login_email'];
  $password = $_POST['login_password'];

  $stmt = $conn->prepare("SELECT id_admin, password FROM admin WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id_admin, $stored_password);
  $stmt->fetch();

  if ($stmt->num_rows > 0) {
      if ($password === $stored_password) {
          $_SESSION['admin_id'] = $id_admin;
          header("Location: admin.php");
          exit();
      } else {
          $error = "Password salah.";
      }
  } else {
      $error = "Email tidak ditemukan.";
  }

  $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link rel="icon" href="img/basinggahsmokol.png">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="wrapper">
  <div class="form-box login active">
    <h2>Admin</h2>
    <form action="log_admin.php" method="post">
      <div class="input-box">
        <input type="email" name="login_email" required>
        <label>Email</label>
      </div>
      <div class="input-box">
        <input type="password" name="login_password" required>
        <label>Password</label>
      </div>
      <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
      <?php endif; ?>
      <button type="submit" class="btn" name="login_submit">Login</button>
    </form>
  </div>
</div>

</body>
</html>