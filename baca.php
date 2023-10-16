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
    $sql_pengguna = "SELECT id FROM ki_pengguna WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $hasil = mysqli_query($konek, $sql_pengguna);
    $ada_pengguna = 0;

    if (mysqli_num_rows($hasil) > 0) {
        $ada_pengguna = 1;
    } else {
        echo "Pengguna tidak ditemukan<br />";
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca - Web Enkripsi - Kelompok 14</title>

    <link rel="stylesheet" href="gaya.css">
</head>

<body>
    <form method="post" action="tambah.php" enctype="multipart/form-data">
        <input type="text" value="<?= $_POST["username"]; ?>" name="username" readonly>
        <input type="password" value="<?= $_POST["password"]; ?>" name="password" readonly>
        <input type="text" placeholder="nama lengkap" name="nama_lengkap" required>
        <input type="text" placeholder="jenis kelamin" name="jenis_kelamin" required>
        <input type="text" placeholder="warga negara" name="warga_negara" required>
        <input type="text" placeholder="agama" name="agama" required>
        <input type="text" placeholder="status kawin" name="status_kawin" required>
        <input type="text" placeholder="no telepon" name="no_telepon" required><br>

        <label for="foto_ktp">foto ktp</label>
        <input type="file" name="foto_ktp">
        <label for="dokumen">dokumen</label>
        <input type="file" name="dokumen">
        <label for="video">video</label>
        <input type="file" name="video">

        <button>Kirim</button>
    </form>

    <?php
    function ambil_data($koneksi, $nama_tabel, $id_pengguna)
    {
        $sql = "SELECT id, id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key FROM " . $nama_tabel . " WHERE id_pengguna = " . $id_pengguna;
        $hasil = mysqli_query($koneksi, $sql);

        echo "<table>
                <caption>Tabel " . $nama_tabel . "</caption>
                <tr>
                    <th>id</th>
                    <th>id_pengguna</th>
                    <th>nama_lengkap</th>
                    <th>jenis_kelamin</th>
                    <th>warga_negara</th>
                    <th>agama</th>
                    <th>status_kawin</th>
                    <th>no_telepon</th>
                    <th>foto_ktp</th>
                    <th>dokumen</th>
                    <th>video</th>
                    <th>init_vector</th>
                    <th>enc_key</th>
                </tr>";

        if (mysqli_num_rows($hasil) > 0) {
            while ($baris = mysqli_fetch_assoc($hasil)) {
                echo "<tr><td>" . $baris["id"] . "</td><td>" . $baris["id_pengguna"] . "</td><td>" . $baris["nama_lengkap"] . "</td><td>" . $baris["jenis_kelamin"] . "</td><td>" . $baris["warga_negara"] . "</td><td>" . $baris["agama"] . "</td><td>" . $baris["status_kawin"] . "</td><td>" . $baris["no_telepon"] . "</td><td>" . $baris["foto_ktp"] . "</td><td>" . $baris["dokumen"] . "</td><td>" . $baris["video"] . "</td><td>" . $baris["init_vector"] . "</td><td>" . $baris["enc_key"] . "</td></tr>";

                if ($nama_tabel == "ki_aes")
                {
                    // dekripsi data AES dari database
                    $nama_lengkap = openssl_decrypt($baris["nama_lengkap"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $jenis_kelamin = openssl_decrypt($baris["jenis_kelamin"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $warga_negara = openssl_decrypt($baris["warga_negara"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $agama = openssl_decrypt($baris["agama"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $status_kawin = openssl_decrypt($baris["status_kawin"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $no_telepon = openssl_decrypt($baris["no_telepon"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $foto_ktp = openssl_decrypt($baris["foto_ktp"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $dokumen = openssl_decrypt($baris["dokumen"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                    $video = openssl_decrypt($baris["video"], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                }
                else if ($nama_tabel == "ki_rc4")
                {
                    // dekripsi data RC4 dari database
                    $nama_lengkap = openssl_decrypt($baris["nama_lengkap"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $jenis_kelamin = openssl_decrypt($baris["jenis_kelamin"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $warga_negara = openssl_decrypt($baris["warga_negara"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $agama = openssl_decrypt($baris["agama"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $status_kawin = openssl_decrypt($baris["status_kawin"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $no_telepon = openssl_decrypt($baris["no_telepon"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $foto_ktp = openssl_decrypt($baris["foto_ktp"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $dokumen = openssl_decrypt($baris["dokumen"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                    $video = openssl_decrypt($baris["video"], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                }
                else if ($nama_tabel == "ki_des")
                {
                    // dekripsi data DES dari database
                    $nama_lengkap = openssl_decrypt($baris["nama_lengkap"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $jenis_kelamin = openssl_decrypt($baris["jenis_kelamin"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $warga_negara = openssl_decrypt($baris["warga_negara"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $agama = openssl_decrypt($baris["agama"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $status_kawin = openssl_decrypt($baris["status_kawin"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $no_telepon = openssl_decrypt($baris["no_telepon"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $foto_ktp = openssl_decrypt($baris["foto_ktp"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $dokumen = openssl_decrypt($baris["dokumen"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                    $video = openssl_decrypt($baris["video"], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                }

                echo "<tr><td>" . $baris["id"] . "</td><td>" . $baris["id_pengguna"] . "</td><td>" . $nama_lengkap . "</td><td>" . $jenis_kelamin . "</td><td>" . $warga_negara . "</td><td>" . $agama . "</td><td>" . $status_kawin . "</td><td>" . $no_telepon . "</td><td>" . $foto_ktp . "</td><td>" . $dokumen . "</td><td>" . $video . "</td><td>" . $baris["init_vector"] . "</td><td>" . $baris["enc_key"] . "</td></tr>";
            }
        } else {
            echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
        }

        echo "</table>";
    }

    if ($ada_pengguna)
    {
        $baris = mysqli_fetch_assoc($hasil);

        $tabel = "ki_aes";
        ambil_data($konek, $tabel, $baris["id"]);

        $tabel = "ki_rc4";
        ambil_data($konek, $tabel, $baris["id"]);

        $tabel = "ki_des";
        ambil_data($konek, $tabel, $baris["id"]);
    }

    mysqli_close($konek);
    ?>
</body>

</html>