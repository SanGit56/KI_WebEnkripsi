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
$dirUnggahData = "data_unggah/" . $username . "/";
$statusUnggah = 1;

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

    // buat lokasi file yang diunggah
    $foto_ktp = $dirUnggahData . basename($_FILES["foto_ktp"]["name"]);
    $dokumen = $dirUnggahData . basename($_FILES["dokumen"]["name"]);
    $video = $dirUnggahData . basename($_FILES["video"]["name"]);

    // cek apakah file adalah file gambar
    if (isset($_FILES["foto_ktp"])) {
        $check = getimagesize($_FILES["foto_ktp"]["tmp_name"]);
        if ($check !== false) {
            echo "File adalah gambar - " . $check["mime"] . ".";
            $statusUnggah = 1;
        } else {
            echo "File bukan gambar";
            $statusUnggah = 0;
        }
    }

    if (file_exists($foto_ktp) || file_exists($dokumen) || file_exists($video)) {
        echo "File sudah ada";
        $statusUnggah = 0;
    }

    if ($_FILES["foto_ktp"]["size"] > 3000000 || $_FILES["dokumen"]["size"] > 1000000 || $_FILES["video"]["size"] > 10000000) {
        echo "Ukuran file terlalu besar";
        $statusUnggah = 0;
    }

    $ekst_gambar = ["jpg", "jpeg", "png"];
    $ekst_dokumen = ["pdf", "doc", "docx", "xls", "xlsx"];
    $ekst_video = ["mp4", "avi", "mkv", "wmv"];

    $ekst_file_gambar = strtolower(pathinfo($foto_ktp, PATHINFO_EXTENSION));
    if (!in_array($ekst_file_gambar, $ekst_gambar)) {
        echo "Hanya bisa JPG, JPEG, dan PNG";
        $statusUnggah = 0;
    }

    $ekst_file_dok = strtolower(pathinfo($dokumen, PATHINFO_EXTENSION));
    if (!in_array($ekst_file_dok, $ekst_dokumen)) {
        echo "Hanya bisa PDF, DOC(X), dan XLS(X)";
        $statusUnggah = 0;
    }

    $ekst_file_vid = strtolower(pathinfo($video, PATHINFO_EXTENSION));
    if (!in_array($ekst_file_vid, $ekst_video)) {
        echo "Hanya bisa MP4, AVI, MKV, dan WMV";
        $statusUnggah = 0;
    }

    /* langkah2:
        1. enkripsi file, lalu pindahkan
        2. enkripsi data lokasi file untuk di tabel, lalu masukkan
    */

    // memindahkan file dari tempat sementara (tmp) ke tempat yang telah ditentukan di $dirUnggahData
    if ($statusUnggah === 0) {
        echo "Gagal syarat unggah";
    } else {
        if (move_uploaded_file($_FILES["foto_ktp"]["tmp_name"], $foto_ktp)) {
            echo "File " . htmlspecialchars(basename($_FILES["foto_ktp"]["name"])) . " telah diunggah";
        } else {
            echo "Gagal unggah gambar";
        }

        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $dokumen)) {
            echo "File " . htmlspecialchars(basename($_FILES["dokumen"]["name"])) . " telah diunggah";
        } else {
            echo "Gagal unggah dokumen";
        }

        if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
            echo "File " . htmlspecialchars(basename($_FILES["video"]["name"])) . " telah diunggah";
        } else {
            echo "Gagal unggah video";
        }
    }

    $sql_aes = "INSERT INTO ki_aes (id_pengguna, nama_lengkap, jenis_kelamin, warga_negara, agama, status_kawin, no_telepon, foto_ktp, dokumen, video) VALUES ('" . $baris["id"] . "', '$nama_lengkap', '$jenis_kelamin', '$warga_negara', '$agama', '$status_kawin', '$no_telepon', '$foto_ktp', '$dokumen', '$video')";

    if ($konek->query($sql_aes) === TRUE) {
        echo "Berhasil menambah data AES";
    } else {
        echo "Gagal: " . $sql . "<br>" . $konek->error;
    }
} else {
    echo "Tidak boleh menambah data";
}

$konek->close();
?>