<?php
// file koneksi
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Kami</title>
    <link rel="icon" href="img/basinggahsmokol.png">
    <link rel="stylesheet" href="css/tim.css">
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
    <main class="about">
        <section>
            <h2>Tim Kami</h2>
            <ul>
                <li>
                    <figure>
                        <img src="img/brando.png" alt="Brando">
                        <figcaption>Brando Mathias</figcaption>
                    </figure>
                </li>
                <br></br>
                <li>
                    <figure>
                        <img src="img/nathan.png" alt="Nathan">
                        <figcaption>Nathanael Tuwaidan</figcaption>
                    </figure>
                </li>
                <br></br>
                <li>
                    <figure>
                        <img src="img/sarmila.png" alt="Sarmila">
                        <figcaption>Sarmila Adabaye</figcaption>
                    </figure>
                </li>
                <br></br>
                <li>
                    <figure>
                        <img src="img/savio.png" alt="Savio">
                        <figcaption>Savio Palendeng</figcaption>
                    </figure>
                </li>
            </ul>
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