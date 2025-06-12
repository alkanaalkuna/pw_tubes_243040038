<?php
require "functions.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userNav = query("SELECT username, foto FROM users WHERE id = $userId")[0];
}

$users = query("SELECT * FROM users ORDER BY username ASC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiketinAja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image" href="img/logo.jpg">
    <style>
        img.rounded-circle {
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">TiketinAja</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="harga/pemesanan.php">Harga</a></li>
                    <li class="nav-item"><a class="nav-link" href="harga/orders.php">Your Orders</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown">
                            <?php if (!empty($userNav['foto'])): ?>
                                <img src="img/profile/<?= $userNav['foto']; ?>" class="rounded-circle me-2" width="28" height="28">
                            <?php else: ?>
                                <i class="fa-solid fa-user me-2"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($userNav['username']); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php" onclick="return confirmLogout()" class="nav-link">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section id="#home">
        <header class="bg-white text-center py-4 shadow-sm">
            <h1 class="fw-bold">Selamat Datang di Tiketinaja!</h1>
            <p class="text-muted">Pesan tiket tempat wisata kolam renang yuhuu! dengan aman, mudah, dan cepat hanya di aplikasi Tiketinaja!</p>
        </header>

        <!-- Carousel -->
        <div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 400px;">
            <!-- Background Image -->
            <div style="
            background: url('img/bg.jpg') center center / cover no-repeat;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 0;
            opacity: 0.35;
            border-radius: 16px;
            ">
            </div>
            <!-- Carousel Centered -->
            <div class="position-relative" style="z-index: 1; width: 100%; max-width: 600px;">
                <div id="wisataCarousel" class="carousel slide mx-auto" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#wisataCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#wisataCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#wisataCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/alain-pierre-lys-MzIE-AbbYCc-unsplash.jpg" class="d-block w-100 rounded" alt="Wisata 1" style="height: 300px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Wisata Air yang Indah</h5>
                                <p>Rasakan keindahan alam yang memukau.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/konrad-burdyn-wsTxyveCsDM-unsplash.jpg" class="d-block w-100 rounded" alt="Wisata 2" style="height: 300px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Petualangan Seru</h5>
                                <p>Jelajahi destinasi wisata air tanpa batas favorit keluarga.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/lhu-shi-hui-YWkRJjctjbA-unsplash.jpg" class="d-block w-100 rounded" alt="Wisata 3" style="height: 300px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Paket Hemat Liburan</h5>
                                <p>Dapatkan promo tiket wisata terbaik!</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#wisataCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#wisataCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-white py-5" id="About">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">About Us</h2>
            <p class="text-muted">Yuhuu! adalah tempat favorit buat melepas penat sambil berenang. Kolam kami selalu terjaga kebersihannya, cocok buat santai atau olahraga!
                Rasakan kesegaran air yang jernih dan fasilitas premium hanya di Kolam Renang Yuhuu! – destinasi renang terbaik di Kota Bandung!</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-light" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="fw-bold mb-3">Contact Us</h2>
                    <p class="text-muted mb-4">Kami siap melayani pertanyaan dan pesanan Anda. Hubungi kami langsung melalui WhatsApp!</p>
                    <a href="https://wa.me/+62881022203633?text=Halo%21%20Saya%20mau%20pesan%20tiket%20kolam%20renang%20Yuhuu!%20bagaimana%20caranya%20yaa?" target="_blank" class="btn btn-success btn-lg mb-4">
                        <i class="fa-brands fa-whatsapp me-2"></i>Chat via WhatsApp
                    </a>
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <a href="#" class="text-decoration-none text-primary">Privacy Policy</a>
                        <span class="text-muted">|</span>
                        <a href="#" class="text-decoration-none text-primary">Terms Of Use</a>
                        <span class="text-muted">|</span>
                        <a href="#" class="text-decoration-none text-primary">Our Company</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3 mt-auto">
        <div class="container">
            <small>&copy; <?= date('Y') ?> TiketinAja. All rights reserved.</small>
        </div>
    </footer>

    <!-- Script Bootstrap -->
    <script>
        function confirmLogout() {
            return confirm("Apakah Anda yakin ingin logout?");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>