<?php
    include 'cek_masuk.php';
    include 'koneksi.php';
    include 'cek_pengguna.php';

    if ($ada_pengguna)
    {
        $id_pemohon = $_POST["id_pemohon"];
        $id_dimohon = $_POST["id_dimohon"];
        
        $sql = "SELECT id, status_akses FROM ki_minta_akses WHERE id_pemohon = '$id_pemohon' AND id_dimohon = '$id_dimohon'";
        $hasil = mysqli_query($konek, $sql);

        if ($_POST["mode_akses"] == "minta")
        {
            if (mysqli_num_rows($hasil) > 0) {
                echo "Permintaan sudah diajukan<br />";
                die();
            }

            $sql_minta_akses = "INSERT INTO ki_minta_akses (id_pemohon, status_akses, id_dimohon) VALUES ('$id_pemohon', '0', '$id_dimohon')";

            if ($konek->query($sql_minta_akses) === TRUE) {
                echo "Berhasil menambah permintaan akses<br />";
            } else {
                echo "Gagal: " . $sql . "<br>" . $konek->error . "<br />";
            }
        }
        else if ($_POST["mode_akses"] == "kasih")
        {
            if (mysqli_num_rows($hasil) > 0) {
                $baris_permintaan = mysqli_fetch_assoc($hasil);

                if ($baris_permintaan["status_akses"]) {
                    echo "Permintaan sudah disetujui<br />";
                    die();
                }
            } else {
                echo "Permintaan tidak ada<br />";
                die();
            }

            $sql_kasih_akses = "UPDATE ki_minta_akses SET status_akses='1' WHERE id_pemohon = '$id_pemohon' AND id_dimohon = '$id_dimohon'";

            if ($konek->query($sql_kasih_akses) === TRUE) {
                echo "Berhasil memberi akses<br />";
            } else {
                echo "Gagal: " . $sql . "<br>" . $konek->error . "<br />";
            }
        }
    }
?>