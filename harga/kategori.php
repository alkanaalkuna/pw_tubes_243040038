<?php
require_once 'functions.php';

$keyword = $_GET['keyword'] ?? '';

$kategori = cari($keyword);
?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($kategori) > 0): ?>
            <?php $i = 1; ?>
            <?php foreach ($kategori as $ktg): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= htmlspecialchars($ktg['nama']); ?></td>
                    <td>Rp<?= number_format($ktg['harga'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($ktg['deskripsi']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Data tidak ditemukan</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>