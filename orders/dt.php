<?php
include 'functions.php';

// Logic sorting
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'tanggal';
$order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'DESC';

// Validasi kolom yang boleh di-sort
$allowed_columns = ['nomor_resi', 'tanggal', 'jenis_tiket', 'status'];
$order_by = in_array($order_by, $allowed_columns) ? $order_by : 'tanggal';
$order_dir = $order_dir === 'ASC' ? 'ASC' : 'DESC';

// Query data tiket + join kategori
$query = "SELECT t.*, k.nama AS nama_kategori 
          FROM tiket t
          JOIN kategori k ON t.jenis_tiket = k.id
          ORDER BY $order_by $order_dir";
$result = mysqli_query($conn, $query);
$tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Tiket</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        th:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>

<body>
    <h1>Daftar Tiket</h1>
    <table>
        <thead>
            <tr>
                <th><a href="?order_by=nomor_resi&order_dir=<?= ($order_by == 'nomor_resi' && $order_dir == 'ASC') ? 'DESC' : 'ASC' ?>">Nomor Resi</a></th>
                <th><a href="?order_by=tanggal&order_dir=<?= ($order_by == 'tanggal' && $order_dir == 'ASC') ? 'DESC' : 'ASC' ?>">Tanggal</a></th>
                <th><a href="?order_by=jenis_tiket&order_dir=<?= ($order_by == 'jenis_tiket' && $order_dir == 'ASC') ? 'DESC' : 'ASC' ?>">Jenis Tiket</a></th>
                <th><a href="?order_by=status&order_dir=<?= ($order_by == 'status' && $order_dir == 'ASC') ? 'DESC' : 'ASC' ?>">Status</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket) : ?>
                <tr>
                    <td><?= htmlspecialchars($ticket['nomor_resi']) ?></td>
                    <td><?= $ticket['tanggal'] ?></td>
                    <td><?= htmlspecialchars($ticket['nama_kategori']) ?></td>
                    <td><?= htmlspecialchars($ticket['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>