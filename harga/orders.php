<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: /pw_tubes_243040038/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data pemesanan milik user login
$query = "
    SELECT tipe_tiket, kuantitas, tanggal, total
    FROM pemesanan
    WHERE user_id = $user_id
    ORDER BY tanggal DESC
";
$pemesanan = query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h2>Riwayat Pemesanan Anda</h2>

    <?php if (count($pemesanan) > 0): ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipe Tiket</th>
                    <th>Kuantitas</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($pemesanan as $order): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $order['tipe_tiket']; ?></td>
                        <td><?= $order['kuantitas']; ?></td>
                        <td><?= $order['tanggal']; ?></td>
                        <td>Rp<?= number_format($order['total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Anda belum memiliki pemesanan.</div>
    <?php endif; ?>

    <a href="/pw_tubes_243040038/index.php" class="btn btn-secondary mt-3">← Kembali ke Halaman Utama</a>
</body>

</html>