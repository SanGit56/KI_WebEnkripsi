<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Web Enkripsi - Kelompok 14</title>

    <link rel="stylesheet" href="gaya.css">
</head>

<body>
    <form method="post" action="baca.php">
        <input type="text" placeholder="username" name="username" required>
        <input type="password" placeholder="password" name="password" required>

        <button>Kirim</button>
    </form>

    <?php
        include 'koneksi.php';
        
        $sql = "SELECT id, username, password, katasandi FROM ki_pengguna";
        $hasil = mysqli_query($konek, $sql);

        echo "<table>
            <caption>Tabel ki_pengguna (gunakan akun di bawah ini)</caption>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>katasandi</th>
            </tr>";

        if (mysqli_num_rows($hasil) > 0) {
            while ($baris = mysqli_fetch_assoc($hasil)) {
                echo "<tr>
                    <td>" . $baris["id"] . "</td>
                    <td>" . $baris["username"] . "</td>
                    <td>" . $baris["password"] . "</td>
                    <td>" . $baris["katasandi"] . "</td>
                </tr>";
            }
        } else {
            echo "<tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>";
        }

        echo "</table>";

        mysqli_close($konek);
    ?>
</body>

</html>