<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: /pw_tubes_243040038/login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $conn = koneksi();
    $tanggal = $_POST['tanggal'];
    $kuota_dewasa = $_POST['kuota_dewasa'];
    $kuota_anak = $_POST['kuota_anak'];

    $query = "INSERT INTO kuota_tiket (tanggal, kuota_dewasa, kuota_anak)
              VALUES ('$tanggal', '$kuota_dewasa', '$kuota_anak')";
    mysqli_query($conn, $query);

    header("Location: kuota.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Kuota Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h2>Tambah Kuota Tiket</h2>

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
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="kuota.php" class="btn btn-secondary">Batal</a>
    </form>
</body>

</html>