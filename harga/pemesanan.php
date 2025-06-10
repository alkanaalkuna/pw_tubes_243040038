<?php
require_once "functions.php";

$kategori = query("SELECT * FROM kategori");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $kategori = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Harga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" style="max-width: 600px; font-size: 0.9rem;">
        <div class="row">
            <div class="col">
                <h3 style="font-size:1.3rem; font-family: 'Segoe UI', Arial, sans-serif;">Daftar Harga Kolam Renang YUHUu!</h3>

                <form action="" method="post" class="mb-2">
                    <input type="text" name="keyword" size="20" id="keyword" autofocus placeholder="cari kategori tiket.." autocomplete="off" class="form-control form-control-sm d-inline-block" style="width: 60%;">
                </form>


                <div id="container">
                    <!-- Tabel default yang muncul sebelum pencarian -->
                    <table class="table table-bordered table-hover mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kategori as $ktg): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $ktg['nama'] ?></td>
                                    <td>Rp<?= number_format($ktg['harga'], 0, ',', '.') ?></td>
                                    <td><?= $ktg['deskripsi'] ?></td>
                                    <td>
                                        <a href="bayar.php?tipe=<?= $ktg['nama']; ?>&harga=<?= $ktg['harga']; ?>" class="btn btn-success btn-sm">Pesan</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <script src="script.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>