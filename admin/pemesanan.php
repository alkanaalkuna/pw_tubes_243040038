<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$conn = koneksi();

$sort_by = $_GET['sort_by'] ?? 'tanggal';
$order = $_GET['order'] ?? 'desc';
$valid_columns = ['id', 'user_id', 'tipe_tiket', 'kuantitas', 'total', 'tanggal'];
if (!in_array($sort_by, $valid_columns)) $sort_by = 'tanggal';
$order = ($order === 'asc') ? 'ASC' : 'DESC';

$pemesanan = query("SELECT * FROM pemesanan ORDER BY $sort_by $order");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Pemesanan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2 class="mb-4">Data Pemesanan Tiket</h2>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><a href="?sort_by=id&order=<?= ($sort_by == 'id' && $order == 'ASC') ? 'desc' : 'asc' ?>">ID</a></th>
                <th><a href="?sort_by=user_id&order=<?= ($sort_by == 'user_id' && $order == 'ASC') ? 'desc' : 'asc' ?>">User</a></th>
                <th><a href="?sort_by=tipe_tiket&order=<?= ($sort_by == 'tipe_tiket' && $order == 'ASC') ? 'desc' : 'asc' ?>">Tipe Tiket</a></th>
                <th><a href="?sort_by=kuantitas&order=<?= ($sort_by == 'kuantitas' && $order == 'ASC') ? 'desc' : 'asc' ?>">Qty</a></th>
                <th><a href="?sort_by=total&order=<?= ($sort_by == 'total' && $order == 'ASC') ? 'desc' : 'asc' ?>">Total</a></th>
                <th><a href="?sort_by=tanggal&order=<?= ($sort_by == 'tanggal' && $order == 'ASC') ? 'desc' : 'asc' ?>">Tanggal</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pemesanan as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['user_id']; ?></td>
                    <td><?= $p['tipe_tiket']; ?></td>
                    <td><?= $p['kuantitas']; ?></td>
                    <td><?= number_format($p['total'], 0, ',', '.'); ?>K</td>
                    <td><?= $p['tanggal']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
</body>

</html>