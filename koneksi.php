<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "makananmanado";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>