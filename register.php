<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="idxstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include("config.php");

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
 
        //verify username

        $verify_query = mysqli_query($konek,"SELECT username FROM ki_pengguna WHERE username='$username'");

        if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                    <p>Username ini telah digunakan, tolong gunakan username lain!</p>
                </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        }
        else{

        mysqli_query($konek,"INSERT INTO ki_pengguna(username,password,katasandi) VALUES('$username','$hashedPassword','$password')") or die("Error Occured");


        echo "<div class='message'>
                    <p>Registration successfully!</p>
                </div> <br>";
        echo "<a href='index.php'><button class='btn'>Login Now</button>";

        }

        }else{

        ?>
        <form id="form" action="" method="post">
            <h1>Sign Up</h1>
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username" autocomplete="off" required>
                <div class="error"></div>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required>
                <div class="error"></div>
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <button type="submit" class="btn">Sign Up</button>

            <div class="register-link">
                <p>Already have an account? <a href="index.php">Sign In</a></p>
            </div>
        </form>
    </div>
    <?php } ?>

</body>

</html>