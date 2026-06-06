<?php

function koneksi() {
    $conn = mysqli_connect("localhost", "root", "root", "ifcarweekly");

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    return $conn;
}

function tampildata($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($conn);

    return $rows;
}
