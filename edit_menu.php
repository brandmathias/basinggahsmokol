<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: log_admin.php");
    exit();
}

// file koneksi
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM menu WHERE id=$id");
    $menu = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_menu'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $target = "img/" . basename($image);

        if ($image) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $sql = "UPDATE menu SET name='$name', price='$price', image='$image' WHERE id=$id";
            } else {
                echo "Gagal mengunggah gambar.";
            }
        } else {
            $sql = "UPDATE menu SET name='$name', price='$price' WHERE id=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Item Menu</title>
  <link rel="icon" href="img/basinggahsmokol.png">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<header class="admin-header">
  <div class="admin-logo">Panel<span>Admin.</span></div>
  <a href="logout_admin.php" class="btn">Log Out</a>
</header>

<main class="admin-panel">
  <h2>Edit Item Menu</h2>
  <form method="post" enctype="multipart/form-data" class="admin-section">
    <label for="name">Nama:</label>
    <input type="text" id="name" name="name" value="<?php echo $menu['name']; ?>" required>
    <label for="price">Harga:</label>
    <input type="text" id="price" name="price" value="<?php echo $menu['price']; ?>" required>
    <label for="image">Gambar:</label>
    <input type="file" id="image" name="image" accept="image/*">
    <button type="submit" name="edit_menu" class="btn">Simpan Perubahan</button>
  </form>
</main>

<footer>
  <p>&copy; 2024 Basinggah Smokol. Hak cipta dilindungi.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>
