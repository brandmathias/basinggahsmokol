<?php
// file koneksi
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $saran = $_POST['saran'];

    $stmt = $conn->prepare("INSERT INTO saran (nama, email, saran) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $saran);

    if ($stmt->execute()) {
        echo "Saran Anda telah dikirim.";
    } else {
        echo "Gagal mengirim saran. Silakan coba lagi.";
    }

    $stmt->close();
}

$conn->close();
?>
