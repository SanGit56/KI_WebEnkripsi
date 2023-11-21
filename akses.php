<?php
    if(!isset($_POST["username"]) || !isset($_POST["password"])) {
        echo "Masuk terlebih dahulu<br />";
        die();
    }

    $namaserver = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $namadb = "buat_belajar";

    $konek = mysqli_connect($namaserver, $usernamedb, $passworddb, $namadb);

    if (!$konek) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($konek, $_POST["username"]);
    $password = hash("sha256", mysqli_real_escape_string($konek, $_POST["password"]));

    // cek apakah pengguna ada
    $sql_cek_pgn = "SELECT id FROM ki_pengguna WHERE username = '$username' AND password = '$password'";
    $hasil_cek_pgn = mysqli_query($konek, $sql_cek_pgn);
    $baris_cek_pgn = mysqli_fetch_assoc($hasil_cek_pgn);
    $ada_pengguna = 0;

    if (mysqli_num_rows($hasil_cek_pgn) > 0) {
        $ada_pengguna = 1;
    } else {
        echo "Pengguna tidak ditemukan<br />";
        die();
    }

    if ($ada_pengguna)
    {
        if ($_POST["mode_akses"] == "minta")
        {
            $id_pemohon = $_POST["id_pemohon"];
            $id_dimohon = $_POST["id_dimohon"];

            $sql_cek_duplikat = "SELECT id FROM ki_minta_akses WHERE id_pemohon = '$id_pemohon' AND id_dimohon = '$id_dimohon'";
            $hasil_cek_duplikat = mysqli_query($konek, $sql_cek_duplikat);

            if (mysqli_num_rows($hasil_cek_duplikat) > 0) {
                echo "permintaan sudah diajukan<br />";
                die();
            }

            $sql_minta_akses = "INSERT INTO ki_minta_akses (id_pemohon, status_akses, id_dimohon) VALUES ('$id_pemohon', '0', '$id_dimohon')";

            if ($konek->query($sql_minta_akses) === TRUE) {
                echo "Berhasil menambah permintaan akses<br />";
            } else {
                echo "Gagal: " . $sql . "<br>" . $konek->error . "<br />";
            }
        }
        else if ($_POST["mode_akses"] == "kasih")
        {
            $id_pemohon = $_POST["id_pemohon"];
            $id_dimohon = $_POST["id_dimohon"];

            $sql_cek_permintaan = "SELECT id, status_akses FROM ki_minta_akses WHERE id_pemohon = '$id_pemohon' AND id_dimohon = '$id_dimohon'";
            $hasil_cek_permintaan = mysqli_query($konek, $sql_cek_permintaan);

            if (mysqli_num_rows($hasil_cek_permintaan) > 0) {
                $baris_cek_permintaan = mysqli_fetch_assoc($hasil_cek_permintaan);

                if ($baris_cek_permintaan["status_akses"]) {
                    echo "permintaan sudah disetujui<br />";
                    die();
                }
            } else {
                echo "permintaan tidak ada<br />";
                die();
            }

            $sql_minta_akses = "UPDATE ki_minta_akses SET status_akses='1' WHERE id_pemohon = '$id_pemohon' AND id_dimohon = '$id_dimohon'";

            if ($konek->query($sql_minta_akses) === TRUE) {
                echo "Berhasil memberi akses<br />";
            } else {
                echo "Gagal: " . $sql . "<br>" . $konek->error . "<br />";
            }
        }
    }
?>