<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: /pw_tubes_243040038/login.php");
    exit;
}

// Ambil semua data pemesanan + user info
$query = "
    SELECT p.id, u.username, p.tipe_tiket, p.kuantitas, p.tanggal, p.total
    FROM pemesanan p
    JOIN users u ON p.user_id = u.id
    ORDER BY p.tanggal DESC
";
$pemesanan = query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Semua Pesanan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h2>Daftar Semua Pemesanan</h2>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
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
                    <td><?= $order['username']; ?></td>
                    <td><?= $order['tipe_tiket']; ?></td>
                    <td><?= $order['kuantitas']; ?></td>
                    <td><?= $order['tanggal']; ?></td>
                    <td>Rp<?= number_format($order['total'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin.php" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</body>

</html>