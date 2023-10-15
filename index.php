<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Enkripsi - Kelompok 14</title>

    <link rel="stylesheet" href="gaya.css">
</head>

<body>
    <form method="post" action="tambah.php">
        <input type="text" placeholder="username" name="username" required>
        <input type="password" placeholder="password" name="password" required>
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
    function ambil_data($koneksi, $kueri_sql, $nama_tabel)
    {
        $hasil = mysqli_query($koneksi, $kueri_sql);

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
            }
        } else {
            echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
        }

        echo "</table>";
    }

    $namaserver = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $namadb = "buat_belajar";

    $konek = mysqli_connect($namaserver, $usernamedb, $passworddb, $namadb);

    if (!$konek) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $sql_pengguna = "SELECT id, username, password, katasandi FROM ki_pengguna";
    $hasil = mysqli_query($konek, $sql_pengguna);

    echo "<table>
            <caption>Tabel ki_pengguna</caption>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>katasandi</th>
            </tr>";

    if (mysqli_num_rows($hasil) > 0) {
        while ($baris = mysqli_fetch_assoc($hasil)) {
            echo "<tr><td>" . $baris["id"] . "</td><td>" . $baris["username"] . "</td><td>" . $baris["password"] . "</td><td>" . $baris["katasandi"] . "</td></tr>";
        }
    } else {
        echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
    }

    echo "</table>";
    
    $sql_aes = "SELECT id, id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key FROM ki_aes";
    $tabel = "ki_aes";
    ambil_data($konek, $sql_aes, $tabel);

    $sql_rc4 = "SELECT id, id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key FROM ki_rc4";
    $tabel = "ki_rc4";
    ambil_data($konek, $sql_rc4, $tabel);

    $sql_des = "SELECT id, id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key FROM ki_des";
    $tabel = "ki_des";
    ambil_data($konek, $sql_des, $tabel);

    mysqli_close($konek);
    ?>
</body>

</html>