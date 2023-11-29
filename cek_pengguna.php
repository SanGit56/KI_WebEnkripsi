<?php
    $username = mysqli_real_escape_string($konek, $_POST["username"]);
    $password = hash("sha256", mysqli_real_escape_string($konek, $_POST["password"]));

    $sql_cek_pgn = "SELECT id FROM ki_pengguna WHERE username = '$username' AND password = '$password'";
    $hasil_cek_pgn = mysqli_query($konek, $sql_cek_pgn);

    $ada_pengguna = 0;
    $id_pgn_msk = "";

    if (mysqli_num_rows($hasil_cek_pgn) > 0) {
        $ada_pengguna = 1;
        $id_pgn_msk = mysqli_fetch_assoc($hasil_cek_pgn)["id"];
    } else {
        echo "Pengguna tidak ditemukan<br />";
        die();
    }
?>