<?php
require 'function.php';
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginpage.html');
}

if (isset($_POST["submit"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah_diary($_POST) > 0) {
        echo "
			<script>
				alert('Your Story Has Been Added!');
				document.location.href = 'index.php';
			</script>
		";
    } else {	
        	echo mysqli_error($db);
			"<script>
				alert('Your story can't be added. Try again');
				document.location.href = 'buat.php';
			</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create My Diary</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container panel panel-default" style="display:block; margin-top:40px; 
	margin-left: auto; margin-right: auto; width:60%;">
		<div>
		   <h3>Today's Diary</h3>
				<br> 
				<form method="POST" action="">
					<div class="form-group row">
						<div class="col-sm-8">
							<label for="">Mood :</label>
							<select class="form-control col-sm-6"  name="id_mood_fk" id="id_mood_fk">
								<option value="1">Happy</option>
								<option value="2">Normal</option>
								<option value="3">Angry</option>
								<option value="4">Sad</option>
								<option value="5">Sick</option>
								<option value="6">Tired</option>
								<option value="7">Nervous</option>
								<option value="8">Energetic</option>
								<option value="9">Bored</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10">
							<input type="text" name="story" class="form-control" 
							placeholder="So, What Happened Today?">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10">
							<input type="text" name="thanks" class="form-control" 
							placeholder="What Am I Grateful For Today?">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10">
							<input type="text" name="motivasi" class="form-control" 
							placeholder="My Quotes">
						</div>
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-secondary">Save</button>
					</div>
				<br>
			</div>
	</div>
	<div  class="container" style="display:block; margin-top:20px; margin-left: auto; margin-right: auto; 
		width:60%;">
		<a href="home.php">
        <button class="btn btn-primary" type="button"> Back </button>
        </a>	
	</div>
</body>
</html>