<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: /pw_tubes_243040038/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
</head>

<body>
    <h1>Selamat datang, <?= $_SESSION['username']; ?> (Admin)</h1>

    <div class="list-group">
        <a href="kuota.php" class="list-group-item list-group-item-action">
            Kelola Kuota Tiket
        </a>
        <!-- Tambah menu lain kalau mau -->
        <!-- <a href="admin/kategori.php" class="list-group-item list-group-item-action">Kelola Kategori</a> -->
        <div class="list-group">
            <a href="kuotat.php" class="list-group-item list-group-item-action">
                Kelola Kuota Tiket Tambahan
            </a>
            <div class="list-group">
                <a href="kuotae.php" class="list-group-item list-group-item-action">
                    Kelola Kuota Tiket Edit
                </a>
                <div class="list-group">
                    <a href="admin/orders.php" class="list-group-item list-group-item-action">📋 Lihat Semua Pesanan</a>
                    </a>
                </div>
                <div class="list-group">
                    <a href="../index.php" class="list-group-item list-group-item-action">Kembali ke beranda</a>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <a href="/pw_tubes_243040038/logout.php">Logout</a>

</body>

</html>