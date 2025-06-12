<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .kontainer-profil {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .header-profil {
            text-align: center;
            margin-bottom: 30px;
        }

        .judul-profil {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .tombol-logout {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #f8f9fa;
            color: #dc3545;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .tombol-logout:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kontainer-profil">
            <div class="text-center mb-3">
                <?php if (!empty($user['foto'])): ?>
                    <img src="img/profile/<?= $user['foto']; ?>" width="80" height="80" class="rounded-circle mb-2">
                <?php else: ?>
                    <i class="fas fa-user-circle fa-3x text-secondary mb-2"></i>
                <?php endif; ?>
                <h5><?= htmlspecialchars($user['username']); ?></h5>
            </div>

            <div class="header-profil">
                <div class="judul-profil">PROFIL</div>
            </div>

            <div class="isi-profil">
                <!-- Tambahkan konten profil di sini jika diperlukan -->

                <!-- Tombol Logout/Pindah Akun -->
                <button class="tombol-logout">
                    <i class="fas fa-sign-out-alt me-2"></i>LOGOUT/PINDAH AKUN
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>