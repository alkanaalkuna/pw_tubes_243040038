<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$tipe = $_GET['tipe'] ?? '-';
$harga = (int) ($_GET['harga'] ?? 0);
$kuantitas = 1; // kamu bisa tambahkan fitur pilih jumlah nanti
$tanggal = date('Y-m-d');
$total = $harga * $kuantitas;

$conn = koneksi();
mysqli_query($conn, "INSERT INTO pemesanan (user_id, tipe_tiket, kuantitas, tanggal, total)
VALUES ('$user_id', '$tipe', '$kuantitas', '$tanggal', '$total')");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Simulasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2>Simulasi Pembayaran</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama Pengguna:</strong> <?= $_SESSION['username']; ?></p>
            <p><strong>Tipe Tiket:</strong> <?= htmlspecialchars($tipe); ?></p>
            <p><strong>Harga Tiket:</strong> Rp<?= number_format($harga, 0, ',', '.'); ?></p>
            <p><strong>Status:</strong> <span class="badge bg-success">Pembayaran Berhasil</span></p>
        </div>
    </div>
    <a href="../orders.php" class="btn btn-primary mt-3">📋 Lihat Riwayat Pemesanan</a>
    <a href="pemesanan.php" class="btn btn-secondary mt-3">← Kembali ke Harga Tiket</a>
</body>

</html>