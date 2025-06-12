<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$conn = koneksi();

$totalUsers = query("SELECT COUNT(*) AS total FROM users")[0]['total'];
$totalKategori = query("SELECT COUNT(*) AS total FROM kategori")[0]['total'];
$totalTransaksi = query("SELECT COUNT(*) AS total FROM pemesanan")[0]['total'];
$totalKuota = query("SELECT COUNT(*) AS total FROM kuota_tiket")[0]['total'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .logout-btn {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .card-title {
            font-size: 1rem;
        }

        .stat-number {
            font-size: 1.6rem;
            font-weight: bold;
        }

        .list-group-item a {
            text-decoration: none;
            color: #333;
        }

        .list-group-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <h1 class="h3 mb-3 mb-md-0">Dashboard Admin</h1>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon">👤</div>
                        <div class="card-title">Total User</div>
                        <div class="stat-number"><?= $totalUsers; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon">📦</div>
                        <div class="card-title">Kategori</div>
                        <div class="stat-number"><?= $totalKategori; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-white bg-warning shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon">🧾</div>
                        <div class="card-title">Transaksi</div>
                        <div class="stat-number"><?= $totalTransaksi; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-white bg-danger shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon">🎟️</div>
                        <div class="card-title">Data Kuota</div>
                        <div class="stat-number"><?= $totalKuota; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h5>Manajemen Data</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="kategoriadmin.php">🛠 Kelola Kategori Tiket</a></li>
                <li class="list-group-item"><a href="pemesanan.php">📋 Data Pemesanan</a></li>
                <li class="list-group-item"><a href="kuota.php">🎯 Manajemen Kuota Tiket</a></li>
            </ul>
        </div>
    </div>
</body>

</html>