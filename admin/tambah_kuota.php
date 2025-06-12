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
    $tanggal = $_POST['tanggal'];
    $dewasa = (int) $_POST['kuota_dewasa'];
    $anak = (int) $_POST['kuota_anak'];

    // Cek apakah tanggal sudah ada
    $cek = query("SELECT * FROM kuota_tiket WHERE tanggal = '$tanggal'");
    if ($cek) {
        $error = "Kuota untuk tanggal tersebut sudah ada.";
    } else {
        $query = "INSERT INTO kuota_tiket (tanggal, kuota_dewasa, kuota_anak, terjual_dewasa, terjual_anak)
                  VALUES ('$tanggal', $dewasa, $anak, 0, 0)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $success = "Kuota berhasil ditambahkan.";
        } else {
            $error = "Gagal menambahkan kuota.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Kuota Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2 class="mb-4">Tambah Kuota Tiket</h2>

    <?php if ($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kuota Dewasa</label>
            <input type="number" name="kuota_dewasa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kuota Anak</label>
            <input type="number" name="kuota_anak" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="kuota.php" class="btn btn-secondary">← Kembali</a>
    </form>
</body>

</html>