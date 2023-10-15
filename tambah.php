<?php
$namaserver = "localhost";
$usernamedb = "root";
$passworddb = "";
$namadb = "buat_belajar";

$konek = mysqli_connect($namaserver, $usernamedb, $passworddb, $namadb);

if (!$konek) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$username = mysqli_real_escape_string($konek, $_POST["username"]);
$password = mysqli_real_escape_string($konek, $_POST["password"]);

// cek apakah pengguna ada
$sql_pengguna = "SELECT id FROM ki_pengguna WHERE username = " . $username . " AND password = " . $password;
$hasil = mysqli_query($konek, $sql_pengguna);

// buat folder untuk menyimpan file unggahan
$dirUnggahData = "data_unggah/" . $username;
$statusUnggah = 1;

$key_aes = openssl_random_pseudo_bytes(16);
$iv_aes = openssl_random_pseudo_bytes(16); 

if (mysqli_num_rows($hasil) > 0) {
    // ambil data dari hasil bacaan database
    $baris = mysqli_fetch_assoc($hasil);

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

    var_dump($foto_ktp);
    die();

    // validasi file
    $gambarTipeMime = ['image/jpeg', 'image/png', 'image/jpg'];
    $dokTipeMime = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    $vidTipeMime = ['video/mp4', 'video/x-matroska', 'video/x-ms-wmv'];

    if (!in_array($_FILES["foto_ktp"]["type"], $gambarTipeMime) || !in_array($_FILES["dokumen"]["type"], $dokTipeMime) || !in_array($_FILES["video"]["type"], $vidTipeMime)) {
        echo "Jenis file tidak sah";
        $statusUnggah = 0;
    }

    if ($_FILES["foto_ktp"]["size"] > 3000000 || $_FILES["dokumen"]["size"] > 1000000 || $_FILES["video"]["size"] > 10000000) {
        echo "Ukuran file terlalu besar";
        $statusUnggah = 0;
    }

    // memindahkan file dari tempat sementara (tmp) ke tempat yang telah ditentukan di $dirUnggahData
    if ($statusUnggah === 0) {
        echo "Gagal syarat unggah";
    } else {
        // enkripsi AES
        $nama_lengkap_aes = openssl_encrypt($nama_lengkap, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $jenis_kelamin_aes = openssl_encrypt($jenis_kelamin, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $warga_negara_aes = openssl_encrypt($warga_negara, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $agama_aes = openssl_encrypt($agama, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $status_kawin_aes = openssl_encrypt($status_kawin, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $no_telepon_aes = openssl_encrypt($no_telepon, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $foto_ktp_aes = openssl_encrypt($foto_ktp, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $dokumen_aes = openssl_encrypt($dokumen, 'AES-128-CBC', $key_aes, 0, $iv_aes);
        $video_aes = openssl_encrypt($video, 'AES-128-CBC', $key_aes, 0, $iv_aes);

        $sql_aes = "INSERT INTO ki_aes (id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video) VALUES ('" . $baris["id"] . "', '$nama_lengkap_aes', '$jenis_kelamin_aes', '$warga_negara_aes', '$agama_aes', '$status_kawin_aes', '$no_telepon_aes', '$foto_ktp_aes', '$dokumen_aes', '$video_aes')";

        if ($konek->query($sql_aes) === TRUE) {
            echo "Berhasil menambah data AES";
        } else {
            echo "Gagal: " . $sql . "<br>" . $konek->error;
        }

        // buat lokasi file yang diunggah
        $foto_ktp_alamat = $dirUnggahData . "/" . $foto_ktp_aes;
        $dokumen_alamat = $dirUnggahData . "/" . $dokumen_aes;
        $video_alamat = $dirUnggahData . "/" . $video_aes;

        if (move_uploaded_file($_FILES["foto_ktp"]["tmp_name"], $foto_ktp_alamat)) {
            echo "File " . htmlspecialchars(basename($_FILES["foto_ktp"]["name"])) . " telah diunggah";
        } else {
            echo "Gagal unggah gambar";
        }

        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $dokumen_alamat)) {
            echo "File " . htmlspecialchars(basename($_FILES["dokumen"]["name"])) . " telah diunggah";
        } else {
            echo "Gagal unggah dokumen";
        }

        if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile_alamat)) {
            echo "File " . htmlspecialchars(basename($_FILES["video"]["name"])) . " telah diunggah";
        } else {
            echo "Gagal unggah video";
        }

        // in php, how to encrypt text form submission with rc4 encryption with cfb modes of operation?

        // in php, how to encrypt text form submission with des encryption with ofb modes of operation?
    }
} else {
    echo "Tidak boleh menambah data";
}

$konek->close();
?>