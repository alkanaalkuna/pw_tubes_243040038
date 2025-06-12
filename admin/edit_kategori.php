<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$conn = koneksi();
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: kategori.php");
    exit;
}

$kategori = query("SELECT * FROM kategori WHERE id = $id");
if (!$kategori) {
    echo "<p>Data tidak ditemukan.</p>";
    exit;
}
$kategori = $kategori[0];

$success = '';
$error = '';

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (int) $_POST['harga'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    $query = "UPDATE kategori SET nama = '$nama', harga = $harga, deskripsi = '$deskripsi' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $success = "Data berhasil diperbarui.";
    } else {
        $error = "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2 class="mb-4">Edit Kategori Tiket</h2>

    <?php if ($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $kategori['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $kategori['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required><?= $kategori['deskripsi']; ?></textarea>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="kategoriadmin.php" class="btn btn-secondary">← Kembali</a>
    </form>
</body>

</html>