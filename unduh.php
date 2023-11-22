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

    function cleanString($inputString) {
        // Define a regular expression to replace forbidden characters with underscores
        $cleanedString = preg_replace('/[\/:*?"<>|]/', '_', $inputString);
    
        // Optionally trim and sanitize the string further based on your needs
        $cleanedString = trim($cleanedString);
    
        return $cleanedString;
    }

    function ambil_file($koneksi, $nama_tabel, $id_pengguna)
    {
        $sql = "SELECT id, id_pengguna, foto_ktp, dokumen, video, init_vector, enc_key FROM " . $nama_tabel . " WHERE id_pengguna = '" . $id_pengguna . "'";
        $hasil = mysqli_query($koneksi, $sql);
        
        if (mysqli_num_rows($hasil) > 0) {
            $i = 0;

            // Create a zip archive of the decrypted files
            $zipFile = $id_pengguna . '_' . $nama_tabel . '_dek.zip';
            $zip = new ZipArchive;
            $zip->open($zipFile, ZipArchive::CREATE);
            
            while ($baris = mysqli_fetch_assoc($hasil)) {
                // alamat file milik pengguna
                $filePengguna = "data_unggah/" . $baris["id_pengguna"];
                
                foreach ($baris as $kolom => $nilai_sel)
                {
                    if ($kolom == "foto_ktp" || $kolom == "dokumen" || $kolom == "video")
                    {
                        // cari file
                        $alamatFile = $filePengguna. "_" . $nama_tabel . "_enk/" . cleanString($baris[$kolom]);
                        if (!file_exists($alamatFile)) {
                            continue;
                        }

                        // dekripsi file
                        $encryptedData = file_get_contents($alamatFile);

                        if ($nama_tabel == "ki_aes") {
                            $nama_file = openssl_decrypt($baris[$kolom], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                        } else if ($nama_tabel == "ki_rc4") {
                            $nama_file = openssl_decrypt($baris[$kolom], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                            $decryptedData = openssl_decrypt($encryptedData, 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                        } else if ($nama_tabel == "ki_des") {
                            $nama_file = openssl_decrypt($baris[$kolom], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                            $decryptedData = openssl_decrypt($encryptedData, 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                        }

                        $fileBaru = $filePengguna . "_" . $nama_tabel . "_dek/";
                        if (!file_exists($fileBaru)) {
                            mkdir($fileBaru, 0777, true);
                        }

                        file_put_contents($fileBaru . $i . $nama_file, $decryptedData);

                        $zip->addFile($fileBaru, basename($fileBaru));

                        $i += 1;
                    }
                }
            }

            if ($zip->close() !== true) {
                echo 'ZipArchive Error: ' . $zip->getStatusString();
            }

            // Offer the zip archive for download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFile . '"');
            header('Content-Length: ' . filesize($zipFile));

            readfile($zipFile);
            unlink($zipFile);
        }
    }

    if ($ada_pengguna)
    {
        $baris = mysqli_fetch_assoc($hasil);

        if ($_POST["algo_enkripsi"] == "ki_aes") {
            $tabel = "ki_aes";
            ambil_file($konek, $tabel, $baris["id"]);
        } else if ($_POST["algo_enkripsi"] == "ki_rc4") {
            $tabel = "ki_rc4";
            ambil_file($konek, $tabel, $baris["id"]);
        } else if ($_POST["algo_enkripsi"] == "ki_des") {
            $tabel = "ki_des";
            ambil_file($konek, $tabel, $baris["id"]);
        }
    }

    mysqli_close($konek);
?>