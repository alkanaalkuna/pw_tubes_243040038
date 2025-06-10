<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: /pw_tubes_243040038/login.php");
    exit;
}

$kuota = query("SELECT * FROM kuota_tiket ORDER BY tanggal ASC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Kelola Kuota Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h2>Kelola Kuota Tiket</h2>
    <a href="kuota_tambah.php" class="btn btn-success mb-3">+ Tambah Kuota</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kuota Dewasa</th>
                <th>Terjual Dewasa</th>
                <th>Kuota Anak</th>
                <th>Terjual Anak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kuota as $k): ?>
                <tr>
                    <td><?= $k['tanggal']; ?></td>
                    <td><?= $k['kuota_dewasa']; ?></td>
                    <td><?= $k['terjual_dewasa']; ?></td>
                    <td><?= $k['kuota_anak']; ?></td>
                    <td><?= $k['terjual_anak']; ?></td>
                    <td>
                        <a href="kuotae.php?id=<?= $k['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="admin.php" class="btn btn-secondary">Kembali ke Dashboard</a>
</body>

</html>