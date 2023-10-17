<?php
if(!isset($_POST["username"]) || !isset($_POST["password"])) {
    echo "Masuk terlebih dahulu<br />";
    die();
}

function unggah_data($koneksi, $nama_tabel, $dirUnggahData, $id, $nama_lengkap, $jenis_kelamin, $warga_negara, $agama, $status_kawin, $no_telepon, $foto_ktp, $dokumen, $video, $iv, $key)
{
    $sql = "INSERT INTO " . $nama_tabel . " (id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video, init_vector, enc_key) VALUES ('$id', '$nama_lengkap', '$jenis_kelamin', '$warga_negara', '$agama', '$status_kawin', '$no_telepon', '$foto_ktp', '$dokumen', '$video', '$iv', '$key')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Berhasil menambah data " . $nama_tabel . "<br />";
    } else {
        echo "Gagal: " . $sql . "<br>" . $koneksi->error . "<br />";
    }

    // enkripsi file
    $foto_ktp_asli = file_get_contents($_FILES["foto_ktp"]["tmp_name"]);
    $dokumen_asli = file_get_contents($_FILES["dokumen"]["tmp_name"]);
    $video_asli = file_get_contents($_FILES["video"]["tmp_name"]);

    if ($nama_tabel == "ki_aes")
    {
        $foto_ktp_enkripsi = openssl_encrypt($foto_ktp_asli, 'aes-256-cbc', $key, 0, $iv);
        $dokumen_enkripsi = openssl_encrypt($dokumen_asli, 'aes-256-cbc', $key, 0, $iv);
        $video_enkripsi = openssl_encrypt($video_asli, 'aes-256-cbc', $key, 0, $iv);
    }
    else if ($nama_tabel == "ki_rc4")
    {
        $foto_ktp_enkripsi = openssl_encrypt($foto_ktp_asli, 'rc4', $key, 0, $iv);
        $dokumen_enkripsi = openssl_encrypt($dokumen_asli, 'rc4', $key, 0, $iv);
        $video_enkripsi = openssl_encrypt($video_asli, 'rc4', $key, 0, $iv);
    }
    else if ($nama_tabel == "ki_des")
    {
        $foto_ktp_enkripsi = openssl_encrypt($foto_ktp_asli, 'des-ede3-ofb', $key, 0, $iv);
        $dokumen_enkripsi = openssl_encrypt($dokumen_asli, 'des-ede3-ofb', $key, 0, $iv);
        $video_enkripsi = openssl_encrypt($video_asli, 'des-ede3-ofb', $key, 0, $iv);
    }

    // buat lokasi baru file yang dienkripsi
    $foto_ktp_alamat = $dirUnggahData . "/" . $foto_ktp;
    $dokumen_alamat = $dirUnggahData . "/" . $dokumen;
    $video_alamat = $dirUnggahData . "/" . $video;

    // pindahkan data terenkripsi ke file baru
    file_put_contents($foto_ktp_alamat, $foto_ktp_enkripsi);
    file_put_contents($dokumen_alamat, $dokumen_enkripsi);
    file_put_contents($video_alamat, $video_enkripsi);
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

$statusUnggah = 1;

// setel iv dan key enkripsi
$iv_aes = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$key_aes = random_bytes(32);
// $iv_rc4 = openssl_random_pseudo_bytes(openssl_cipher_iv_length('rc4'));
$key_rc4 = random_bytes(32);
$iv_des = openssl_random_pseudo_bytes(openssl_cipher_iv_length('des-ede3-ofb'));
$key_des = random_bytes(32);

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
    $dirUnggahData = "data_unggah/" . $baris["id"];

    // memindahkan file dari tempat sementara (tmp) ke tempat yang telah ditentukan di $dirUnggahData
    if ($statusUnggah === 0) {
        echo "Gagal syarat unggah<br />";
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
        unggah_data($konek, $tabel, $dirUnggahData, $baris["id"], $nama_lengkap_aes, $jenis_kelamin_aes, $warga_negara_aes, $agama_aes, $status_kawin_aes, $no_telepon_aes, $foto_ktp_aes, $dokumen_aes, $video_aes, $iv_aes, $key_aes);

        // enkripsi RC4
        $nama_lengkap_rc4 = openssl_encrypt($nama_lengkap, 'rc4', $key_rc4, 0, $iv_rc4);
        $jenis_kelamin_rc4 = openssl_encrypt($jenis_kelamin, 'rc4', $key_rc4, 0, $iv_rc4);
        $warga_negara_rc4 = openssl_encrypt($warga_negara, 'rc4', $key_rc4, 0, $iv_rc4);
        $agama_rc4 = openssl_encrypt($agama, 'rc4', $key_rc4, 0, $iv_rc4);
        $status_kawin_rc4 = openssl_encrypt($status_kawin, 'rc4', $key_rc4, 0, $iv_rc4);
        $no_telepon_rc4 = openssl_encrypt($no_telepon, 'rc4', $key_rc4, 0, $iv_rc4);
        $foto_ktp_rc4 = openssl_encrypt($foto_ktp, 'rc4', $key_rc4, 0, $iv_rc4);
        $dokumen_rc4 = openssl_encrypt($dokumen, 'rc4', $key_rc4, 0, $iv_rc4);
        $video_rc4 = openssl_encrypt($video, 'rc4', $key_rc4, 0, $iv_rc4);

        $tabel = "ki_rc4";
        unggah_data($konek, $tabel, $dirUnggahData, $baris["id"], $nama_lengkap_rc4, $jenis_kelamin_rc4, $warga_negara_rc4, $agama_rc4, $status_kawin_rc4, $no_telepon_rc4, $foto_ktp_rc4, $dokumen_rc4, $video_rc4, $iv_rc4, $key_rc4);

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
        unggah_data($konek, $tabel, $dirUnggahData, $baris["id"], $nama_lengkap_des, $jenis_kelamin_des, $warga_negara_des, $agama_des, $status_kawin_des, $no_telepon_des, $foto_ktp_des, $dokumen_des, $video_des, $iv_des, $key_des);

        echo "Berhasil menambah data<br />";
    }
} else {
    echo "Pengguna tidak terdaftar. Tidak boleh menambah data<br />";
}

$konek->close();
?>