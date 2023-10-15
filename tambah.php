<?php
function unggah_data($koneksi, $nama_tabel, $dirUnggahData, $id, $nama_lengkap, $jenis_kelamin, $warga_negara, $agama, $status_kawin, $no_telepon, $foto_ktp, $dokumen, $video, $iv, $key)
{
    $sql = "INSERT INTO " . $nama_tabel . " (id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key) VALUES ('$id', '$nama_lengkap', '$jenis_kelamin', '$warga_negara', '$agama', '$status_kawin', '$no_telepon', '$foto_ktp', '$dokumen', '$video', '$iv', '$key')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Berhasil menambah data " . $nama_tabel;
    } else {
        echo "Gagal: " . $sql . "<br>" . $koneksi->error;
    }

    // buat lokasi file yang diunggah
    $foto_ktp_alamat = $dirUnggahData . "/" . $foto_ktp;
    $dokumen_alamat = $dirUnggahData . "/" . $dokumen;
    $video_alamat = $dirUnggahData . "/" . $video;

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

    if (move_uploaded_file($_FILES["video"]["tmp_name"], $video_alamat)) {
        echo "File " . htmlspecialchars(basename($_FILES["video"]["name"])) . " telah diunggah";
    } else {
        echo "Gagal unggah video";
    }
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
$password = mysqli_real_escape_string($konek, $_POST["password"]);

// cek apakah pengguna ada
$sql_pengguna = "SELECT id FROM ki_pengguna WHERE username = " . $username . " AND password = " . $password;
$hasil = mysqli_query($konek, $sql_pengguna);

// buat folder untuk menyimpan file unggahan
$dirUnggahData = "data_unggah/" . $username;
$statusUnggah = 1;

// setel iv dan key enkripsi
$iv_aes = openssl_random_pseudo_bytes(16);
$key_aes = openssl_random_pseudo_bytes(32);
$iv_rc4 = "1234567890abcdef0";
$key_rc4 = "0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef";
$iv_des = "12345678";
$key_des = "0123456789abcdef";

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

        $tabel = "ki_aes";
        unggah_data($konek, $tabel, $dirUnggahData, $baris["id"], $nama_lengkap_aes, $jenis_kelamin_aes, $warga_negara_aes, $agama_aes, $status_kawin_aes, $no_telepon_aes, $foto_ktp_aes, $dokumen_aes, $video_aes, $iv_aes, $key_aes);

        // enkripsi RC4
        $nama_lengkap_rc4 = base64_encode(openssl_encrypt($nama_lengkap, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $jenis_kelamin_rc4 = base64_encode(openssl_encrypt($jenis_kelamin, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $warga_negara_rc4 = base64_encode(openssl_encrypt($warga_negara, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $agama_rc4 = base64_encode(openssl_encrypt($agama, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $status_kawin_rc4 = base64_encode(openssl_encrypt($status_kawin, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $no_telepon_rc4 = base64_encode(openssl_encrypt($no_telepon, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $foto_ktp_rc4 = base64_encode(openssl_encrypt($foto_ktp, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $dokumen_rc4 = base64_encode(openssl_encrypt($dokumen, 'rc4-ctr', $key_rc4, 0, $iv_rc4));
        $video_rc4 = base64_encode(openssl_encrypt($video, 'rc4-ctr', $key_rc4, 0, $iv_rc4));

        $tabel = "ki_rc4";
        unggah_data($konek, $tabel, $dirUnggahData, $baris["id"], $nama_lengkap_rc4, $jenis_kelamin_rc4, $warga_negara_rc4, $agama_rc4, $status_kawin_rc4, $no_telepon_rc4, $foto_ktp_rc4, $dokumen_rc4, $video_rc4, $iv_rc4, $key_rc4);

        // enkripsi DES
        $nama_lengkap_des = base64_encode(openssl_encrypt($nama_lengkap, 'des-ofb', $key_des, 0, $iv_des));
        $jenis_kelamin_des = base64_encode(openssl_encrypt($jenis_kelamin, 'des-ofb', $key_des, 0, $iv_des));
        $warga_negara_des = base64_encode(openssl_encrypt($warga_negara, 'des-ofb', $key_des, 0, $iv_des));
        $agama_des = base64_encode(openssl_encrypt($agama, 'des-ofb', $key_des, 0, $iv_des));
        $status_kawin_des = base64_encode(openssl_encrypt($status_kawin, 'des-ofb', $key_des, 0, $iv_des));
        $no_telepon_des = base64_encode(openssl_encrypt($no_telepon, 'des-ofb', $key_des, 0, $iv_des));
        $foto_ktp_des = base64_encode(openssl_encrypt($foto_ktp, 'des-ofb', $key_des, 0, $iv_des));
        $dokumen_des = base64_encode(openssl_encrypt($dokumen, 'des-ofb', $key_des, 0, $iv_des));
        $video_des = base64_encode(openssl_encrypt($video, 'des-ofb', $key_des, 0, $iv_des));

        $tabel = "ki_des";
        unggah_data($konek, $tabel, $dirUnggahData, $baris["id"], $nama_lengkap_des, $jenis_kelamin_des, $warga_negara_des, $agama_des, $status_kawin_des, $no_telepon_des, $foto_ktp_des, $dokumen_des, $video_des, $iv_des, $key_des);
    }
} else {
    echo "Tidak boleh menambah data";
}

$konek->close();
?>