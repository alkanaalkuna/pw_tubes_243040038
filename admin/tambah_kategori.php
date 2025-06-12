<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$conn = koneksi();
$success = '';
$error = '';

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (int) $_POST['harga'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    $query = "INSERT INTO kategori (nama, harga, deskripsi) VALUES ('$nama', $harga, '$deskripsi')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $success = "Data berhasil ditambahkan.";
    } else {
        $error = "Gagal menambahkan data.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2 class="mb-4">Tambah Kategori Tiket</h2>

    <?php if ($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="kategoriadmin.php" class="btn btn-secondary">← Kembali</a>
    </form>
</body>

</html>