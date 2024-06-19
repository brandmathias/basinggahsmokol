<?php
// file koneksi
include 'koneksi.php';

$menus = $conn->query("SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
    <link rel="icon" href="img/basinggahsmokol.png">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-logo">Basinggah<span>Smokol.</span></div>
        <nav class="navbar-nav">
            <a href="index.php">Informasi</a>
            <a href="menu.php">Menu</a>
            <a href="tim.php">Tim Kami</a>
            <a href="saran.php">Saran</a>
            <a href="logout.php">Log Out</a>
        </nav>
    </header>
    <main class="menu">
        <section>
            <h2>Menu Makanan dan Minuman</h2>
            <div class="row">
                <?php while ($row = $menus->fetch_assoc()): ?>
                <div class="menu-card">
                    <img src="img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3 class="menu-card-title"><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['price']; ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>
    <footer>
    <div class="footer-contact">
        <div class="contact-item">
            <i class="fas fa-phone-alt"></i>
            <a href="tel:+6282188769679"><span>+6282188769679</span></a>
        </div>
        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <a href="mailto:basinggahsmokol@gmail.com"><span>basinggahsmokol@gmail.com</span></a>
        </div>
        <div class="contact-item">
            <i class="fas fa-map-marker-alt"></i>
            <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Laut+Aru+No+34,+Ranotana,+Manado" target="_blank">
                <span>Jl. Laut Aru No 34, Ranotana, Manado</span>
            </a>
        </div>
    </div>
    <p>&copy; 2024 Basinggah Smokol. All rights reserved.</p>
</footer>

</body>
</html>

</body>
</html>

<?php
$conn->close();
?>