<?php
require 'function.php';
session_start();
 
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginpage.html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Diary</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container home"style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading" style="text-align:center; font-family: Georgia, 'Times New Roman', Times, serif;">
                            <h1>My Diary</h1>
                    </div>
                    <hr>
                    <div class="panel-body d-flex justify-content-center" style="text-align:center; font-family: Georgia, 'Times New Roman', Times, serif;">
                        <div class="box">
                            <button class="btn btn-lg btn-secondary" type="button" style="margin-bottom:20px;"> <a href="buat.php">Create A Diary</a></button>
                            <br>
                            <button class="btn btn-lg btn-secondary" type="button"> <a href="index.php">My Diarys</a></button>
                            <br>
                            <a href="logout.php" class="text-right" style="font-size:15px;margin-top:20px;margin-left:10px;display:flex;">Logout</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>