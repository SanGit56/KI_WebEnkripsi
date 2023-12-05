<?php
    include 'cek_masuk.php';
    include 'koneksi.php';
    include 'cek_pengguna.php';

    function cleanString($inputString) 
    {
        // Define a regular expression to replace forbidden characters with underscores
        $cleanedString = preg_replace('/[\/:*?"<>|]/', '_', $inputString);
    
        // Optionally trim and sanitize the string further based on your needs
        $cleanedString = trim($cleanedString);
    
        return $cleanedString;
    }

    function dekripsi_file($nama_tabel, $id_pengguna, $i, $kolom, $iv, $key)
    {
        $filePengguna = "data_unggah/" . $id_pengguna . "_" . $nama_tabel;
        $alamatFile = $filePengguna . "_enk/" . cleanString($kolom);

        // dekripsi file
        $encryptedData = file_get_contents($alamatFile);
        $nama_file = "";
        $decryptedData = "";

        if ($nama_tabel == "ki_aes")
        {
            $nama_file = openssl_decrypt($kolom, 'aes-256-cbc', $key, 0, $iv);
            $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
        }
        else if ($nama_tabel == "ki_rc4")
        {
            $nama_file = openssl_decrypt($kolom, 'rc4', $key, 0, $iv);
            $decryptedData = openssl_decrypt($encryptedData, 'rc4', $key, 0, $iv);
        }
        else if ($nama_tabel == "ki_des")
        {
            $nama_file = openssl_decrypt($kolom, 'des-ede3-ofb', $key, 0, $iv);
            $decryptedData = openssl_decrypt($encryptedData, 'des-ede3-ofb', $key, 0, $iv);
        }

        $fileBaru = $filePengguna . "_dek/";
        if (!file_exists($fileBaru)) {
            mkdir($fileBaru, 0777, true);
        }

        $nama_file_baru = $fileBaru . $i . $nama_file;
        file_put_contents($nama_file_baru, $decryptedData);

        return $nama_file_baru;
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
            // $zip->open($zipFile, ZipArchive::CREATE);
            if ($zip->open($zipFile, ZipArchive::CREATE) !== true) {
                echo 'Zip open Error: ' . $zip->getStatusString();
                die();
            }
            
            while ($baris = mysqli_fetch_assoc($hasil)) {
                $nama_foto = dekripsi_file($nama_tabel, $id_pengguna, $i++, $baris["foto_ktp"], $baris["init_vector"], $baris["enc_key"]);
                // $zip->addFile($nama_foto, basename($nama_foto));
                if ($zip->addFile($nama_foto, basename($nama_foto)) !== true) {
                    echo 'Zip foto Error: ' . $zip->getStatusString();
                    die();
                }

                $nama_dok = dekripsi_file($nama_tabel, $id_pengguna, $i++, $baris["dokumen"], $baris["init_vector"], $baris["enc_key"]);
                // $zip->addFile($nama_dok, basename($nama_dok));
                if ($zip->addFile($nama_dok, basename($nama_dok)) !== true) {
                    echo 'Zip dok Error: ' . $zip->getStatusString();
                    die();
                }
        
                $nama_vid = dekripsi_file($nama_tabel, $id_pengguna, $i++, $baris["video"], $baris["init_vector"], $baris["enc_key"]);
                // $zip->addFile($nama_vid, basename($nama_vid));
                if ($zip->addFile($nama_vid, basename($nama_vid)) !== true) {
                    echo 'Zip vid Error: ' . $zip->getStatusString();
                    die();
                }
            }

            if ($zip->close() !== true) {
                echo 'Zip close Error: ' . $zip->getStatusString();
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