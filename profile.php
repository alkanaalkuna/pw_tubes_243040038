<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$conn = koneksi();
$id = $_SESSION['user_id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];

$success = '';
$error = '';


// Proses update profil
if (isset($_POST['simpan'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $fotoBaru = $user['foto'];



    // Upload foto jika ada
    if ($_FILES['foto']['name']) {
        $namaFile = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        $validExt = ['jpg', 'jpeg', 'png'];

        if (in_array($ext, $validExt)) {
            $namaBaru = uniqid() . '.' . $ext;
            if (!is_dir('img/profile')) {
                mkdir('img/profile', 0755, true);
            }
            if ($_FILES['foto']['size'] > 1048576) { // 1 MB
                $error = "Ukuran foto maksimal 1MB.";
            }

            move_uploaded_file($tmp, 'img/profile/' . $namaBaru);
            $fotoBaru = $namaBaru;
        } else {
            $error = "Format foto tidak valid (hanya jpg/jpeg/png).";
        }
    }

    // Update password jika diisi
    if (!empty($error)) {
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE users SET username = '$username', password = '$password', foto = '$fotoBaru' WHERE id = $id");
        } else {
            mysqli_query($conn, "UPDATE users SET username = '$username', foto = '$fotoBaru' WHERE id = $id");
        }

        $result = true;

        if ($result) {
            $_SESSION['username'] = $username;
            $success = "Data berhasil diperbarui.";
        } else {
            $error = "Gagal memperbarui data.";
        }

        // $_SESSION['username'] = $username;
        // header("Location: profile.php");
        // exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h2>Profil Saya</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" style="max-width: 400px;">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Password Baru <small>(opsional)</small></label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Foto Profil <small>(opsional)</small></label><br>
            <?php if ($user['foto']) : ?>
                <img src="img/profile/<?= $user['foto']; ?>" width="80" class="mb-2 rounded"><br>
            <?php endif; ?>
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
    </form>
</body>

</html>