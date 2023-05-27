<?php
require 'function.php';

// Memeriksa apakah form create account telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek apakah username telah digunakan sebelumnya
    $checkUsernameQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkUsernameResult = $db->query($checkUsernameQuery);

    if ($checkUsernameResult->num_rows > 0) {
        // Username telah digunakan
        echo "
			<script>
				alert('This username has been used. Please choose another username');
				document.location.href = 'register.php';
			</script>
		";
    } else {
        // Menyimpan username dan password baru ke dalam database
        $insertQuery = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

        if ($db->query($insertQuery) === TRUE) {
            // Akun berhasil dibuat
            echo "
			<script>
				alert('Congratulations, you have an account!');
				document.location.href = 'loginpage.html';
			</script>
		";
        } else {
            // Terjadi kesalahan saat menyimpan ke database
            echo "Terjadi kesalahan: " . $db->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container"style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading" style="text-align:center; font-family: Georgia, 'Times New Roman', Times, serif;">
                        <h1>Create Account</h1>
                    </div>
                    <hr>
                    <div class="panel-body">
                        <div class="box">
                                <form action="register.php" method="POST">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Username</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" name="submit" class="form-control btn btn-primary" tabindex="4">Submit</button>
                                </form>
                            <br><br>
                            <div>
                                <a href="loginpage.html">
                                    <button class="btn btn-primary" type="button">Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>