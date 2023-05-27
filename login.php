<?php
require 'function.php';
session_start();

// Memeriksa apakah form login telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek apakah username dan password cocok dalam database
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        // Login berhasil
        $_SESSION['username'] = $username;
        header("Location: home.php");
    } else {
        // Login gagal
        echo "
			<script>
				alert('Username/Password salah!');
				document.location.href = 'loginpage.html';
			</script>
		";
    }
}
?>


<?php
// variable pendefinisian kredensial
//$usernamelogin = 'admin';
//$passwordlogin = 'Admintor-123';

// memulai session
//session_start();

// mengambil isian dari form login
//$username = $_POST['username'];
//$password = $_POST['password'];

// pengecekan kredensial login
//if ($username == $usernamelogin && $password == $passwordlogin) {
//    $_SESSION['username'] = $username;
//    header("Location: home.php");
//} else {
//    echo "
//			<script>
//				alert('Username/Password salah!');
//				document.location.href = 'loginpage.html';
//			</script>
//		";
//}