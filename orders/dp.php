<?php
include 'functions.php';

// Logic sorting
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'tanggal';
$order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'DESC';

// Validasi kolom
$allowed_columns = ['name', 'tanggal', 'total'];
$order_by = in_array($order_by, $allowed_columns) ? $order_by : 'tanggal';

// Query data pemesanan
$query = "SELECT p.*, u.name, k.nama AS jenis_tiket 
          FROM pemesanan p
          JOIN users u ON p.user_id = u.id
          JOIN kategori k ON p.tipe_tiket = k.id
          ORDER BY $order_by $order_dir";
$result = mysqli_query($conn, $query);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Tampilkan tabel pemesanan dengan sorting -->
<table>
    <thead>
        <tr>
            <th><a href="?order_by=name&order_dir=<?= ($order_by == 'name' && $order_dir == 'ASC') ? 'DESC' : 'ASC' ?>">Nama User</a></th>
            <th><a href="?order_by=tanggal&order_dir=<?= ($order_by == 'tanggal' && $order_dir == 'ASC') ? 'DESC' : 'ASC' ?>">Tanggal</a></th>
            <th>Jenis Tiket</th>
            <th>Kuantitas</th>
            <th><a href="?order_by=total&order_dir=<?= ($order_by == 'total' && $order_dir == 'ASC') ? 'DESC' : 'ASC' ?>">Total</a></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?= htmlspecialchars($order['name']) ?></td>
                <td><?= $order['tanggal'] ?></td>
                <td><?= htmlspecialchars($order['jenis_tiket']) ?></td>
                <td><?= $order['kuantitas'] ?></td>
                <td>Rp <?= number_format($order['total'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>