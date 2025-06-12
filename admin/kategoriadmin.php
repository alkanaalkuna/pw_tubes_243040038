<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$conn = koneksi();

// Sorting
$sort_by = $_GET['sort_by'] ?? 'id';
$order = $_GET['order'] ?? 'asc';
$valid_columns = ['id', 'nama', 'harga'];
if (!in_array($sort_by, $valid_columns)) $sort_by = 'id';
$order = ($order === 'desc') ? 'DESC' : 'ASC';

$kategori = query("SELECT * FROM kategori ORDER BY $sort_by $order");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Kategori Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2 class="mb-4">Manajemen Kategori Tiket</h2>

    <a href="tambah_kategori.php" class="btn btn-primary mb-3">➕ Tambah Kategori</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><a href="?sort_by=id&order=<?= ($sort_by == 'id' && $order == 'ASC') ? 'desc' : 'asc' ?>">ID</a></th>
                <th><a href="?sort_by=nama&order=<?= ($sort_by == 'nama' && $order == 'ASC') ? 'desc' : 'asc' ?>">Nama</a></th>
                <th><a href="?sort_by=harga&order=<?= ($sort_by == 'harga' && $order == 'ASC') ? 'desc' : 'asc' ?>">Harga</a></th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategori as $ktg): ?>
                <tr>
                    <td><?= $ktg['id']; ?></td>
                    <td><?= $ktg['nama']; ?></td>
                    <td><?= number_format($ktg['harga'], 0, ',', '.'); ?>K</td>
                    <td><?= $ktg['deskripsi']; ?></td>
                    <td>
                        <a href="edit_kategori.php?id=<?= $ktg['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_kategori.php?id=<?= $ktg['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
</body>

</html>