<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: log_admin.php");
    exit();
}

// file koneksi
include 'koneksi.php';

// Mengambil data menu
$menus = $conn->query("SELECT * FROM menu");

// Menangani pengiriman form untuk menambah item menu baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_menu'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "img/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO menu (name, price, image) VALUES ('$name', '$price', '$image')";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Gagal mengunggah gambar.";
    }
}

// Menangani penghapusan item menu
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM menu WHERE id=$delete_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Admin</title>
  <link rel="icon" href="img/basinggahsmokol.png">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<header class="admin-header">
  <div class="admin-logo">Panel<span>Admin.</span></div>
  <nav class="navbar">
    <div class="navbar-nav">
      <a href="data_user.php">Data User</a>
      <a href="edit_menu.php">Edit Menu</a>
      <a href="lihat_saran.php">Lihat Saran</a>
    </div>
  </nav>
  <a href="logout_admin.php" class="btn logout">Log Out</a>
</header>


<main class="admin-panel">
  <section id="add-menu" class="admin-section">
    <h2>Tambah Item Menu</h2>
    <form method="post" enctype="multipart/form-data" class="admin-form">
      <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="price">Harga:</label>
        <input type="text" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
      </div>
      <button type="submit" name="add_menu" class="btn">Tambah Item Menu</button>
    </form>
  </section>

  <section id="view-menu" class="admin-section">
    <h2>Lihat Item Menu</h2>
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $menus->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['price']; ?></td>
          <td><img src="img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="50"></td>
          <td>
            <a href="edit_menu.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
            <a href="admin.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </section>
</main>

<footer>
  <p>&copy; 2024 Basinggah Smokol. Hak cipta dilindungi.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>
