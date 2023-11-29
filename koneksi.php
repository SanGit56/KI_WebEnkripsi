<?php
    $namaserver = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $namadb = "buat_belajar";

    $konek = mysqli_connect($namaserver, $usernamedb, $passworddb, $namadb);

    if (!$konek) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>