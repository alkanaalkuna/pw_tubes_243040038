<?php
function koneksi()
{
    $conn = mysqli_connect('localhost', 'root', '', 'tiketaja');
    return $conn;
}

function query($query)
{
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari($keyword)
{
    $conn = koneksi();
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM kategori WHERE nama LIKE '$keyword%'";
    return query($query);
}
