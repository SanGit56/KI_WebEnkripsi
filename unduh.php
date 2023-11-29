<?php
    include 'cek_masuk.php';
    include 'koneksi.php';
    include 'cek_pengguna.php';

    function cleanString($inputString) {
        // Define a regular expression to replace forbidden characters with underscores
        $cleanedString = preg_replace('/[\/:*?"<>|]/', '_', $inputString);
    
        // Optionally trim and sanitize the string further based on your needs
        $cleanedString = trim($cleanedString);
    
        return $cleanedString;
    }

    function ambil_file($koneksi, $nama_tabel, $id_pengguna)
    {
        $sql = "SELECT id, foto_ktp, dokumen, video, init_vector, enc_key FROM $nama_tabel WHERE id_pengguna = '$id_pengguna'";
        $hasil = mysqli_query($koneksi, $sql);
        
        if (mysqli_num_rows($hasil) > 0) {
            $i = 1;

            // Create a zip archive of the decrypted files
            $zipFile = $id_pengguna . '_' . $nama_tabel . '_dek.zip';
            $zip = new ZipArchive;
            $zip->open($zipFile, ZipArchive::CREATE);
            
            while ($baris = mysqli_fetch_assoc($hasil)) {
                // alamat file milik pengguna
                $filePengguna = "data_unggah/" . $id_pengguna . "_" . $nama_tabel;
                
                foreach ($baris as $kolom)
                {
                    if ($kolom == "foto_ktp" || $kolom == "dokumen" || $kolom == "video")
                    {
                        echo '<script>
                            console.log("' . $baris["id"] . $kolom . '");
                        </script>';

                        // cari file
                        $alamatFile = $filePengguna . "_enk/" . cleanString($baris[$kolom]);
                        if (!file_exists($alamatFile)) {
                            continue;
                        }

                        // dekripsi file
                        $encryptedData = file_get_contents($alamatFile);
                        $nama_file = "";
                        $decryptedData = "";

                        if ($nama_tabel == "ki_aes")
                        {
                            $nama_file = openssl_decrypt($baris[$kolom], 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $baris["enc_key"], 0, $baris["init_vector"]);
                        }
                        else if ($nama_tabel == "ki_rc4")
                        {
                            $nama_file = openssl_decrypt($baris[$kolom], 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                            $decryptedData = openssl_decrypt($encryptedData, 'rc4', $baris["enc_key"], 0, $baris["init_vector"]);
                        }
                        else if ($nama_tabel == "ki_des")
                        {
                            $nama_file = openssl_decrypt($baris[$kolom], 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                            $decryptedData = openssl_decrypt($encryptedData, 'des-ede3-ofb', $baris["enc_key"], 0, $baris["init_vector"]);
                        }

                        $fileBaru = $filePengguna . "_dek/";
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
                die();
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
        if ($_POST["algo_enkripsi"] == "ki_aes")
        {
            $tabel = "ki_aes";
            ambil_file($konek, $tabel, $id_pgn_msk);
        }
        else if ($_POST["algo_enkripsi"] == "ki_rc4")
        {
            $tabel = "ki_rc4";
            ambil_file($konek, $tabel, $id_pgn_msk);
        }
        else if ($_POST["algo_enkripsi"] == "ki_des")
        {
            $tabel = "ki_des";
            ambil_file($konek, $tabel, $id_pgn_msk);
        }
    }

    mysqli_close($konek);
?>