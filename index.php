<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="idxstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <?php

        include("config.php");
        if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($konek, $_POST["username"]);
            $password = hash("sha256", mysqli_real_escape_string($konek, $_POST["password"]));

            //cek penggunanya ada apa ngga
            $hasil = mysqli_query($konek, "SELECT id FROM ki_pengguna WHERE username = '" . $username . "' AND password = '" . $password . "'") or die("Select Error");
            $row = mysqli_fetch_assoc($hasil);

            if(is_array($row) && !empty($row)){
                $_SESSION['valid'] = $row['username'];
                $_SESSION['password'] = $row['password'];
            }else{
                echo "<div class='message'>
                  <p>Username atau kata sandi yang dimasukkan salah!</p>
                   </div> <br>";
               echo "<a href='index.php'><button class='btn'>Go Back</button>";
     
            }
            if(isset($_SESSION['valid'])){
                header("Location: home.php");
            }
          }else{

        ?>

        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="username" id="username" name="username" placeholder="Username" autocomplete="off" required>
                <i class='bx bxs-envelope' ></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember-forgot"> Remember me</label>
                <a href="#">Forgot Password</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
    <?php } ?>

</body>

</html>