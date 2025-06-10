<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: /pw_tubes_243040038/login.php");
    exit;
}

$conn = koneksi();

if (!isset($_GET['id'])) {
    header("Location: kuota.php");
    exit;
}

$id = (int) $_GET['id']; // amanin dari SQL injection juga

if (!isset($_GET['id'])) {
    header("Location: kuota.php");
    exit;
}

$id = (int) $_GET['id']; // Cast ke integer untuk amankan input

$data = query("SELECT * FROM kuota_tiket WHERE id = $id")[0];

if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $kuota_dewasa = $_POST['kuota_dewasa'];
    $kuota_anak = $_POST['kuota_anak'];

    $query = "UPDATE kuota_tiket SET 
                tanggal = '$tanggal',
                kuota_dewasa = '$kuota_dewasa',
                kuota_anak = '$kuota_anak'
              WHERE id = $id";

    mysqli_query($conn, $query);

    header("Location: kuota.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Kuota Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h2>Edit Kuota Tiket</h2>

    <form action="" method="post">
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Kuota Dewasa</label>
            <input type="number" name="kuota_dewasa" class="form-control" value="<?= $data['kuota_dewasa']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Kuota Anak</label>
            <input type="number" name="kuota_anak" class="form-control" value="<?= $data['kuota_anak']; ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="kuota.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>

</html>