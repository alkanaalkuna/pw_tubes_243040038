<?php
session_start();
require_once '../functions.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM kategori WHERE id = $id");
}

header("Location: kategoriadmin.php");
exit;
