<?php
session_start();
// file koneksi
include 'koneksi.php';

// Handle Registration
if (isset($_POST['register_submit'])) {
    $username = $_POST['register_username'];
    $password = $_POST['register_password'];
    $email = $_POST['register_email'];
    $confirm_password = $_POST['register_confirm_password'];

    if ($password === $confirm_password) {
        $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            $success = "Registrasi berhasil. Silakan login.";
        } else {
            $error = "Gagal mendaftar. Silakan coba lagi.";
        }
        $stmt->close();
    } else {
        $error = "Konfirmasi password tidak cocok.";
    }
}

// Handle Login
if (isset($_POST['login_submit'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    $stmt = $conn->prepare("SELECT id_user, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_user, $stored_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if ($password === $stored_password) {
            $_SESSION['user_id'] = $id_user;
            header("Location: index.php"); // Redirect to index.php
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
  <title>Login</title>
  <link rel="icon" href="img/basinggahsmokol.png">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>

<div class="wrapper">
  <div id="login-form" class="form-box login active">
    <h2>Login</h2>
    <form action="login.php" method="post">
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
      <div class="login-register">
        <p>Don't have an account? <a href="#" id="show-register" class="register-link">Register</a></p>
      </div>
    </form>
  </div>

  <div id="register-form" class="form-box register">
    <h2>Registration</h2>
    <form action="login.php" method="post">
      <div class="input-box">
        <input type="text" name="register_username" required>
        <label>Username</label>
      </div>
      <div class="input-box">
        <input type="password" name="register_password" required>
        <label>Password</label>
      </div>
      <div class="input-box">
        <input type="email" name="register_email" required>
        <label>Email</label>
      </div>
      <div class="input-box">
        <input type="password" name="register_confirm_password" required>
        <label>Confirm Password</label>
      </div>
      <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
      <?php elseif (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
      <?php endif; ?>
      <button type="submit" class="btn" name="register_submit">Register</button>
      <div class="login-register">
        <p>Already have an account? <a href="#" id="show-login" class="login-link">Login</a></p>
      </div>
    </form>
  </div>
</div>
<script src="login.js"></script>

</body>
</html>