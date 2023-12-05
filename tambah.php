<?php
    include 'cek_masuk.php';
    include 'rc4.php';

    function cleanString($inputString) {
        // Define a regular expression to replace forbidden characters with underscores
        $cleanedString = preg_replace('/[\/:*?"<>|]/', '_', $inputString);

        // Optionally trim and sanitize the string further based on your needs
        $cleanedString = trim($cleanedString);

        return $cleanedString;
    }

    function unggah_data($koneksi, $nama_tabel, $dirUnggahData, $id, $nama_lengkap, $jenis_kelamin, $warga_negara, $agama, $status_kawin, $no_telepon, $foto_ktp, $dokumen, $video, $iv, $key)
    {
        $sql_tambah = "INSERT INTO $nama_tabel (id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key) VALUES ($id, '$nama_lengkap', '$jenis_kelamin', '$warga_negara', '$agama', '$status_kawin', '$no_telepon', '$foto_ktp', '$dokumen', '$video', '$iv', '$key')";

        if ($koneksi->query($sql_tambah) === TRUE) {
            echo "Berhasil menambah data " . $nama_tabel . "<br />";
        } else {
            echo "Gagal: " . $sql_tambah . "<br>" . $koneksi->error . "<br />";
        }

        if ($nama_tabel == "ki_aes")
        {
            $sql_pgn_pny_akses = "SELECT id, id_pemohon FROM ki_minta_akses WHERE id_dimohon = '$id' AND status_akses = '1'";
            $hasil_pgn_pny_akses = mysqli_query($koneksi, $sql_pgn_pny_akses);

            if (mysqli_num_rows($hasil_pgn_pny_akses) > 0)
            {
                while ($baris_pgn_pny_akses = mysqli_fetch_assoc($hasil_pgn_pny_akses))
                {
                    $sql_maks_id_data = "SELECT MAX(id) FROM ki_aes";
                    $hasil_maks_id_data = mysqli_query($koneksi, $sql_maks_id_data);
                    $baris_maks_id_data = mysqli_fetch_assoc($hasil_maks_id_data);
                    $id_data_maks = $baris_maks_id_data["MAX(id)"];
                    $id_pengakses = $baris_pgn_pny_akses["id"];

                    $sql_tmbh_akses_data = "INSERT INTO ki_akses_data (id_pengakses, id_data, init_vector, enc_key) VALUES ('$id_pengakses', '$id_data_maks', '$iv', '$key')";

                    if ($koneksi->query($sql_tmbh_akses_data) === TRUE) {
                        echo "Berhasil menambah data<br />";
                    } else {
                        echo "Gagal: " . $sql_tmbh_akses_data . "<br>" . $koneksi->error . "<br />";
                    }
                }
            }
        }

        $alamat_dir = "data_unggah/" . $id . "_" . $nama_tabel;
        if (!file_exists($alamat_dir)) {
            mkdir($alamat_dir, 0777, true);
        }

        $alamat_foto_ktp = $alamat_dir . '/' . basename($_FILES["foto_ktp"]["name"]);
        $alamat_dokumen = $alamat_dir . '/' . basename($_FILES["dokumen"]["name"]);
        $alamat_video = $alamat_dir . '/' . basename($_FILES["video"]["name"]);

        if (move_uploaded_file($_FILES["foto_ktp"]["tmp_name"], $alamat_foto_ktp)) {
            echo "Berhasil mengunggah foto<br>";
        }
        
        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $alamat_dokumen)) {
            echo "Berhasil mengunggah dokumen<br>";
        }
        
        if (move_uploaded_file($_FILES["video"]["tmp_name"], $alamat_video)) {
            echo "Berhasil mengunggah video<br>";
        }

        // enkripsi file
        $foto_ktp_asli = file_get_contents($alamat_foto_ktp);
        $dokumen_asli = file_get_contents($alamat_dokumen);
        $video_asli = file_get_contents($alamat_video);
        
        $foto_ktp_enkripsi = "";
        $dokumen_enkripsi = "";
        $video_enkripsi = "";

        if ($nama_tabel == "ki_aes")
        {
            $foto_ktp_enkripsi = openssl_encrypt($foto_ktp_asli, 'aes-256-cbc', $key, 0, $iv);
            $dokumen_enkripsi = openssl_encrypt($dokumen_asli, 'aes-256-cbc', $key, 0, $iv);
            $video_enkripsi = openssl_encrypt($video_asli, 'aes-256-cbc', $key, 0, $iv);
        }
        else if ($nama_tabel == "ki_rc4")
        {
            $foto_ktp_enkripsi = rc4_encrypt($foto_ktp_asli, $key);
            $dokumen_enkripsi = rc4_encrypt($dokumen_asli, $key);
            $video_enkripsi = rc4_encrypt($video_asli, $key);
        }
        else if ($nama_tabel == "ki_des")
        {
            $foto_ktp_enkripsi = openssl_encrypt($foto_ktp_asli, 'des-ede3-ofb', $key, 0, $iv);
            $dokumen_enkripsi = openssl_encrypt($dokumen_asli, 'des-ede3-ofb', $key, 0, $iv);
            $video_enkripsi = openssl_encrypt($video_asli, 'des-ede3-ofb', $key, 0, $iv);
        }

        $dirUnggahData = $dirUnggahData . "_" . $nama_tabel . "_enk/";
        if (!file_exists($dirUnggahData)) {
            mkdir($dirUnggahData, 0777, true);
        }

        // buat lokasi baru file yang dienkripsi
        $foto_ktp_alamat = $dirUnggahData . cleanString($foto_ktp);
        $dokumen_alamat = $dirUnggahData . cleanString($dokumen);
        $video_alamat = $dirUnggahData . cleanString($video);

        // pindahkan data terenkripsi ke file baru
        file_put_contents($foto_ktp_alamat, $foto_ktp_enkripsi);
        file_put_contents($dokumen_alamat, $dokumen_enkripsi);
        file_put_contents($video_alamat, $video_enkripsi);
    }

    include 'koneksi.php';
    include 'cek_pengguna.php';

    if (!file_exists("data_unggah")) {
        mkdir("data_unggah", 0777, true);
    }

    $statusUnggah = 1;

    // setel iv dan key enkripsi
    $iv_aes = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $key_aes = random_bytes(32);
    $key_rc4 = rc4_initialize(random_bytes(32));
    $iv_des = openssl_random_pseudo_bytes(openssl_cipher_iv_length('des-ede3-ofb'));
    $key_des = random_bytes(32);

    if ($ada_pengguna) {
        // ambil dan bersihkan hasil isian
        $nama_lengkap = mysqli_real_escape_string($konek, $_POST["nama_lengkap"]);
        $jenis_kelamin = mysqli_real_escape_string($konek, $_POST["jenis_kelamin"]);
        $warga_negara = mysqli_real_escape_string($konek, $_POST["warga_negara"]);
        $agama = mysqli_real_escape_string($konek, $_POST["agama"]);
        $status_kawin = mysqli_real_escape_string($konek, $_POST["status_kawin"]);
        $no_telepon = mysqli_real_escape_string($konek, $_POST["no_telepon"]);
        $foto_ktp = basename($_FILES["foto_ktp"]["name"]);
        $dokumen = basename($_FILES["dokumen"]["name"]);
        $video = basename($_FILES["video"]["name"]);

        // validasi file
        $gambarTipeMime = ['image/jpeg', 'image/png', 'image/jpg'];
        $dokTipeMime = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $vidTipeMime = ['video/mp4', 'video/x-matroska', 'video/x-ms-wmv'];

        if (!in_array($_FILES["foto_ktp"]["type"], $gambarTipeMime) || !in_array($_FILES["dokumen"]["type"], $dokTipeMime) || !in_array($_FILES["video"]["type"], $vidTipeMime)) {
            echo "Jenis file tidak sah<br />";
            $statusUnggah = 0;
        }

        if ($_FILES["foto_ktp"]["size"] > 3000000 || $_FILES["dokumen"]["size"] > 1000000 || $_FILES["video"]["size"] > 10000000) {
            echo "Ukuran file terlalu besar<br />";
            $statusUnggah = 0;
        }
        
        // buat folder untuk menyimpan file unggahan
        $dirUnggahData = "data_unggah/" . $id_pgn_msk;

        // memindahkan file dari tempat sementara (tmp) ke tempat yang telah ditentukan di $dirUnggahData
        if ($statusUnggah === 0) {
            echo "Gagal syarat unggah<br />";
            die();
        } else {
            // enkripsi AES
            $nama_lengkap_aes = openssl_encrypt($nama_lengkap, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $jenis_kelamin_aes = openssl_encrypt($jenis_kelamin, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $warga_negara_aes = openssl_encrypt($warga_negara, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $agama_aes = openssl_encrypt($agama, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $status_kawin_aes = openssl_encrypt($status_kawin, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $no_telepon_aes = openssl_encrypt($no_telepon, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $foto_ktp_aes = openssl_encrypt($foto_ktp, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $dokumen_aes = openssl_encrypt($dokumen, 'aes-256-cbc', $key_aes, 0, $iv_aes);
            $video_aes = openssl_encrypt($video, 'aes-256-cbc', $key_aes, 0, $iv_aes);

            $tabel = "ki_aes";
            unggah_data($konek, $tabel, $dirUnggahData, $id_pgn_msk, $nama_lengkap_aes, $jenis_kelamin_aes, $warga_negara_aes, $agama_aes, $status_kawin_aes, $no_telepon_aes, $foto_ktp_aes, $dokumen_aes, $video_aes, $iv_aes, $key_aes);

            // enkripsi RC4
            $nama_lengkap_rc4 = rc4_encrypt($nama_lengkap, $key_rc4);
            $jenis_kelamin_rc4 = rc4_encrypt($jenis_kelamin, $key_rc4);
            $warga_negara_rc4 = rc4_encrypt($warga_negara, $key_rc4);
            $agama_rc4 = rc4_encrypt($agama, $key_rc4);
            $status_kawin_rc4 = rc4_encrypt($status_kawin, $key_rc4);
            $no_telepon_rc4 = rc4_encrypt($no_telepon, $key_rc4);
            $foto_ktp_rc4 = rc4_encrypt($foto_ktp, $key_rc4);
            $dokumen_rc4 = rc4_encrypt($dokumen, $key_rc4);
            $video_rc4 = rc4_encrypt($video, $key_rc4);

            $tabel = "ki_rc4";
            unggah_data($konek, $tabel, $dirUnggahData, $id_pgn_msk, $nama_lengkap_rc4, $jenis_kelamin_rc4, $warga_negara_rc4, $agama_rc4, $status_kawin_rc4, $no_telepon_rc4, $foto_ktp_rc4, $dokumen_rc4, $video_rc4, $tabel, $key_rc4);

            // enkripsi DES
            $nama_lengkap_des = openssl_encrypt($nama_lengkap, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $jenis_kelamin_des = openssl_encrypt($jenis_kelamin, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $warga_negara_des = openssl_encrypt($warga_negara, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $agama_des = openssl_encrypt($agama, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $status_kawin_des = openssl_encrypt($status_kawin, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $no_telepon_des = openssl_encrypt($no_telepon, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $foto_ktp_des = openssl_encrypt($foto_ktp, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $dokumen_des = openssl_encrypt($dokumen, 'des-ede3-ofb', $key_des, 0, $iv_des);
            $video_des = openssl_encrypt($video, 'des-ede3-ofb', $key_des, 0, $iv_des);

            $tabel = "ki_des";
            unggah_data($konek, $tabel, $dirUnggahData, $id_pgn_msk, $nama_lengkap_des, $jenis_kelamin_des, $warga_negara_des, $agama_des, $status_kawin_des, $no_telepon_des, $foto_ktp_des, $dokumen_des, $video_des, $iv_des, $key_des);

            echo "Berhasil menambah data<br />";
        }
    } else {
        echo "Pengguna tidak terdaftar. Tidak boleh menambah data<br />";
        die();
    }

    $konek->close();
?>