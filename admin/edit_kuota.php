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
    header("Location: kuota.php");
    exit;
}

$kuota = query("SELECT * FROM kuota_tiket WHERE id = $id");
if (!$kuota) {
    echo "<p>Data tidak ditemukan.</p>";
    exit;
}
$kuota = $kuota[0];

$success = '';
$error = '';

if (isset($_POST['simpan'])) {
    $dewasa = (int) $_POST['kuota_dewasa'];
    $anak = (int) $_POST['kuota_anak'];

    $query = "UPDATE kuota_tiket SET kuota_dewasa = $dewasa, kuota_anak = $anak WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $success = "Kuota berhasil diperbarui.";
        $kuota['kuota_dewasa'] = $dewasa;
        $kuota['kuota_anak'] = $anak;
    } else {
        $error = "Gagal memperbarui kuota.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Kuota Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2 class="mb-4">Edit Kuota Tanggal: <?= $kuota['tanggal']; ?></h2>

    <?php if ($success): ?><div class="alert alert-success"><?= $success; ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label>Kuota Dewasa</label>
            <input type="number" name="kuota_dewasa" class="form-control" value="<?= $kuota['kuota_dewasa']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Kuota Anak</label>
            <input type="number" name="kuota_anak" class="form-control" value="<?= $kuota['kuota_anak']; ?>" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="kuota.php" class="btn btn-secondary">← Kembali</a>
    </form>
</body>

</html>