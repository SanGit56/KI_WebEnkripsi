<?php
    include 'cek_masuk.php';
    include 'koneksi.php';
    include 'cek_pengguna.php';
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

        <button>Tambah</button>
    </form>

    <?php
        $sql_ambil_pgn = "SELECT id, username FROM ki_pengguna";
        $hasil_ambil_pgn = mysqli_query($konek, $sql_ambil_pgn);
    
        echo "<table>
            <caption>Tabel ki_minta_akses</caption>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>aksi</th>
            </tr>";
    
        if (mysqli_num_rows($hasil_ambil_pgn) > 0) {
            while ($baris_ambil_pgn = mysqli_fetch_assoc($hasil_ambil_pgn)) {
                echo "<tr>
                <td>" . $baris_ambil_pgn["id"] . "</td>
                <td>" . $baris_ambil_pgn["username"] . "</td>
                <td><form method='post' action='akses.php'>
                        <input type='hidden' value='" . $_POST["username"] . "' name='username'>
                        <input type='hidden' value='" . $_POST["password"] . "' name='password'>
                        <input type='hidden' value='" . $id_pgn_msk . "' name='id_pemohon'>
                        <input type='hidden' value='" . $baris_ambil_pgn["id"] . "' name='id_dimohon'>
                        <input type='hidden' value='minta' name='mode_akses'>
                        <button>minta akses data</button>
                    </form>";

                $sql_cek_minta = "SELECT id, id_pemohon, status_akses, id_dimohon FROM ki_minta_akses WHERE id_dimohon = '$id_pgn_msk' AND status_akses = '0'";
                $hasil_cek_minta = mysqli_query($konek, $sql_cek_minta);

                if (mysqli_num_rows($hasil_cek_minta) > 0) {
                    while ($baris_cek_minta = mysqli_fetch_assoc($hasil_cek_minta)) {
                        if ($baris_cek_minta["id_pemohon"] == $baris_ambil_pgn["id"])
                        {
                            echo "<form method='post' action='akses.php'>
                                <input type='hidden' value='" . $_POST["username"] . "' name='username'>
                                <input type='hidden' value='" . $_POST["password"] . "' name='password'>
                                <input type='hidden' value='" . $baris_ambil_pgn["id"] . "' name='id_pemohon'>
                                <input type='hidden' value='" . $id_pgn_msk . "' name='id_dimohon'>
                                <input type='hidden' value='kasih' name='mode_akses'>
                                <button>kasih akses data</button>
                            </form>";

                            break;
                        }
                    }
                }

                echo "</td></tr>";
            }
        } else {
            echo "<tr>
                <td>-</td>
                <td>-</td>
            </tr>";
        }
    
        echo "</table>";
    ?>

    <form method="post" action="unduh.php">
        <input type="hidden" value="<?= $_POST["username"]; ?>" name="username">
        <input type="hidden" value="<?= $_POST["password"]; ?>" name="password">
        <input type="hidden" value="ki_aes" name="algo_enkripsi">

        <button>Unduh AES</button>
    </form>

    <form method="post" action="unduh.php">
        <input type="hidden" value="<?= $_POST["username"]; ?>" name="username">
        <input type="hidden" value="<?= $_POST["password"]; ?>" name="password">
        <input type="hidden" value="ki_rc4" name="algo_enkripsi">

        <button>Unduh RC4</button>
    </form>

    <form method="post" action="unduh.php">
        <input type="hidden" value="<?= $_POST["username"]; ?>" name="username">
        <input type="hidden" value="<?= $_POST["password"]; ?>" name="password">
        <input type="hidden" value="ki_des" name="algo_enkripsi">

        <button>Unduh DES</button>
    </form>

    <?php
        function ambil_data($koneksi, $nama_tabel, $id_pengguna)
        {
            $sql_baca = "SELECT id, id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key FROM $nama_tabel WHERE id_pengguna = '$id_pengguna'";
            $hasil_baca = mysqli_query($koneksi, $sql_baca);

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

            if (mysqli_num_rows($hasil_baca) > 0) {
                while ($baris_baca = mysqli_fetch_assoc($hasil_baca)) {
                    // menampilkan data mentah dari basisdata
                    echo "<tr><td>" . $baris_baca["id"] . "</td>
                    <td>" . $baris_baca["id_pengguna"] . "</td>
                    <td>" . $baris_baca["nama_lengkap"] . "</td>
                    <td>" . $baris_baca["jenis_kelamin"] . "</td>
                    <td>" . $baris_baca["warga_negara"] . "</td>
                    <td>" . $baris_baca["agama"] . "</td>
                    <td>" . $baris_baca["status_kawin"] . "</td>
                    <td>" . $baris_baca["no_telepon"] . "</td>
                    <td>" . $baris_baca["foto_ktp"] . "</td>
                    <td>" . $baris_baca["dokumen"] . "</td>
                    <td>" . $baris_baca["video"] . "</td>
                    <td>" . base64_encode($baris_baca["init_vector"]) . "</td>
                    <td>" . base64_encode($baris_baca["enc_key"]) . "</td></tr>";

                    // mendekripsi data
                    if ($nama_tabel == "ki_aes")
                    {
                        // dekripsi data AES dari database
                        $nama_lengkap = openssl_decrypt($baris_baca["nama_lengkap"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $jenis_kelamin = openssl_decrypt($baris_baca["jenis_kelamin"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $warga_negara = openssl_decrypt($baris_baca["warga_negara"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $agama = openssl_decrypt($baris_baca["agama"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $status_kawin = openssl_decrypt($baris_baca["status_kawin"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $no_telepon = openssl_decrypt($baris_baca["no_telepon"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $foto_ktp = openssl_decrypt($baris_baca["foto_ktp"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $dokumen = openssl_decrypt($baris_baca["dokumen"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $video = openssl_decrypt($baris_baca["video"], 'aes-256-cbc', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                    }
                    else if ($nama_tabel == "ki_rc4")
                    {
                        // dekripsi data RC4 dari database
                        $nama_lengkap = openssl_decrypt($baris_baca["nama_lengkap"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $jenis_kelamin = openssl_decrypt($baris_baca["jenis_kelamin"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $warga_negara = openssl_decrypt($baris_baca["warga_negara"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $agama = openssl_decrypt($baris_baca["agama"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $status_kawin = openssl_decrypt($baris_baca["status_kawin"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $no_telepon = openssl_decrypt($baris_baca["no_telepon"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $foto_ktp = openssl_decrypt($baris_baca["foto_ktp"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $dokumen = openssl_decrypt($baris_baca["dokumen"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $video = openssl_decrypt($baris_baca["video"], 'rc4', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                    }
                    else if ($nama_tabel == "ki_des")
                    {
                        // dekripsi data DES dari database
                        $nama_lengkap = openssl_decrypt($baris_baca["nama_lengkap"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $jenis_kelamin = openssl_decrypt($baris_baca["jenis_kelamin"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $warga_negara = openssl_decrypt($baris_baca["warga_negara"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $agama = openssl_decrypt($baris_baca["agama"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $status_kawin = openssl_decrypt($baris_baca["status_kawin"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $no_telepon = openssl_decrypt($baris_baca["no_telepon"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $foto_ktp = openssl_decrypt($baris_baca["foto_ktp"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $dokumen = openssl_decrypt($baris_baca["dokumen"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                        $video = openssl_decrypt($baris_baca["video"], 'des-ede3-ofb', $baris_baca["enc_key"], 0, $baris_baca["init_vector"]);
                    }

                    // menampilkan data hasil dekripsi
                    echo "<tr>
                        <td>" . $baris_baca["id"] . "</td>
                        <td>" . $baris_baca["id_pengguna"] . "</td>
                        <td>" . $nama_lengkap . "</td>
                        <td>" . $jenis_kelamin . "</td>
                        <td>" . $warga_negara . "</td>
                        <td>" . $agama . "</td>
                        <td>" . $status_kawin . "</td>
                        <td>" . $no_telepon . "</td>
                        
                        <td><img src='data_unggah/" . $baris_baca["id_pengguna"] . "_" . $nama_tabel . "/" . $foto_ktp . "' alt='" . $foto_ktp . "' width='150' height='150'></td>

                        <td>" . $dokumen . "</td>

                        <td><video width='150' height='150' controls>
                            <source src='data_unggah/" . $baris_baca["id_pengguna"] . "_" . $nama_tabel . "/" . $video . "' type='video/mp4'>
                            " . $video . "
                        </video>" . $video . "</td>
                        
                        <td>" . base64_encode($baris_baca["init_vector"]) . "</td>
                        <td>" . base64_encode($baris_baca["enc_key"]) . "</td>
                    </tr>";
                }
            } else {
                echo "<tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>";
            }

            if ($nama_tabel == "ki_aes")
            {
                $sql_pgn_pny_akses = "SELECT kma.id AS id_kma, kad.id_pengakses, kad.id_data FROM ki_minta_akses kma, ki_akses_data kad WHERE kma.id_pemohon = '$id_pengguna' AND kma.status_akses = '1' AND kma.id = kad.id_pengakses";
                $hasil_pgn_pny_akses = mysqli_query($koneksi, $sql_pgn_pny_akses);

                if (mysqli_num_rows($hasil_pgn_pny_akses) > 0)
                {
                    while ($baris_pgn_pny_akses = mysqli_fetch_assoc($hasil_pgn_pny_akses))
                    {
                        $id_data = $baris_pgn_pny_akses["id_data"];

                        $sql_data_pny_akses = "SELECT id, id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key FROM " . $nama_tabel . " WHERE id = '$id_data'";
                        $hasil_data_pny_akses = mysqli_query($koneksi, $sql_data_pny_akses);

                        if (mysqli_num_rows($hasil_data_pny_akses) > 0) {
                            while ($baris_data_pny_akses = mysqli_fetch_assoc($hasil_data_pny_akses)) {
                                echo "<tr>
                                    <td>" . $baris_data_pny_akses["id"] . "</td>
                                    <td>" . $baris_data_pny_akses["id_pengguna"] . "</td>
                                    <td>" . $baris_data_pny_akses["nama_lengkap"] . "</td>
                                    <td>" . $baris_data_pny_akses["jenis_kelamin"] . "</td>
                                    <td>" . $baris_data_pny_akses["warga_negara"] . "</td>
                                    <td>" . $baris_data_pny_akses["agama"] . "</td>
                                    <td>" . $baris_data_pny_akses["status_kawin"] . "</td>
                                    <td>" . $baris_data_pny_akses["no_telepon"] . "</td>
                                    <td>" . $baris_data_pny_akses["foto_ktp"] . "</td>
                                    <td>" . $baris_data_pny_akses["dokumen"] . "</td>
                                    <td>" . $baris_data_pny_akses["video"] . "</td>
                                    <td>" . base64_encode($baris_data_pny_akses["init_vector"]) . "</td>
                                    <td>" . base64_encode($baris_data_pny_akses["enc_key"]) . "</td>
                                </tr>";
            
                                // dekripsi data AES dari database
                                $nama_lengkap = openssl_decrypt($baris_data_pny_akses["nama_lengkap"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $jenis_kelamin = openssl_decrypt($baris_data_pny_akses["jenis_kelamin"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $warga_negara = openssl_decrypt($baris_data_pny_akses["warga_negara"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $agama = openssl_decrypt($baris_data_pny_akses["agama"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $status_kawin = openssl_decrypt($baris_data_pny_akses["status_kawin"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $no_telepon = openssl_decrypt($baris_data_pny_akses["no_telepon"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $foto_ktp = openssl_decrypt($baris_data_pny_akses["foto_ktp"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $dokumen = openssl_decrypt($baris_data_pny_akses["dokumen"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
                                $video = openssl_decrypt($baris_data_pny_akses["video"], 'aes-256-cbc', $baris_data_pny_akses["enc_key"], 0, $baris_data_pny_akses["init_vector"]);
            
                                echo "<tr>
                                    <td>" . $baris_data_pny_akses["id"] . "</td>
                                    <td>" . $baris_data_pny_akses["id_pengguna"] . "</td>
                                    <td>" . $nama_lengkap . "</td>
                                    <td>" . $jenis_kelamin . "</td>
                                    <td>" . $warga_negara . "</td>
                                    <td>" . $agama . "</td>
                                    <td>" . $status_kawin . "</td>
                                    <td>" . $no_telepon . "</td>
                                    
                                    <td><img src='data_unggah/" . $baris_data_pny_akses["id_pengguna"] . "_" . $nama_tabel . "/" . $foto_ktp . "' alt='" . $foto_ktp . "' width='150' height='150'></td>
                
                                    <td><iframe src='data_unggah/" . $baris_data_pny_akses["id_pengguna"] . "_" . $nama_tabel . "/" . $dokumen . "'  width='150' height='150'></iframe></td>
                
                                    <td><video width='150' height='150' controls>
                                        <source src='data_unggah/" . $baris_data_pny_akses["id_pengguna"] . "_" . $nama_tabel . "/" . $video . "' type='video/mp4'>
                                        Your browser does not support the video tag.
                                    </video>" . $video . "</td>
                                    
                                    <td>" . base64_encode($baris_data_pny_akses["init_vector"]) . "</td>
                                    <td>" . base64_encode($baris_data_pny_akses["enc_key"]) . "</td>
                                </tr>";
                            }
                        }
                    }
                }
            }

            echo "</table>";
        }

        if ($ada_pengguna)
        {
            $tabel = "ki_aes";
            ambil_data($konek, $tabel, $id_pgn_msk);

            $tabel = "ki_rc4";
            ambil_data($konek, $tabel, $id_pgn_msk);

            $tabel = "ki_des";
            ambil_data($konek, $tabel, $id_pgn_msk);
        }

        mysqli_close($konek);
    ?>
</body>

</html>