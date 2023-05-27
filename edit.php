<?php
$db = mysqli_connect("localhost", "root", "", "diary");
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

function query($query)
{
	global $db;
	$result = mysqli_query($db, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// ambil data di URL
$id = $_GET["id"];

$diary = query("SELECT * FROM diary JOIN mood ON mood.id_mood=diary.id_mood_fk WHERE id_diary = $id")[0];


//cek tombol submit sdh ditekan atau belum
if (isset($_POST["submit"])) {
	// cek apakah data berhasil di ubah atau tidak
	if(ubah_diary($_POST) > 0) {
		echo "
				<script>
					alert('data berhasil diubah!');
					document.location.href = 'index.php';
				</script>
		";
	} else {
		echo mysqli_error($db);
				"<script>
					alert('data gagal diubah!');
					document.location.href = 'edit.php';
				</script>
		";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Diary</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<div class="container panel panel-default" style="display:block; margin-left: auto; margin-right: auto; 
		   margin-top:30px; width:60%;">
		<div>
		   <h3>Today's Diary</h3>
				<br>
				<form method="POST" action="">
					<div class="form-group row">
						<input type="hidden" name="id_diary" value="<?php echo $diary["id_diary"]; ?>">
						<div class="col-sm-8">
							<select class="form-control col-sm-6" name="id_mood_fk" id="id_mood_fk">
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
							<input type="text" name="story" class="form-control" placeholder="So, What Happened Today?" 
							required value="<?php echo $diary["story"]; ?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10">
							<input type="text" name="thanks" class="form-control" placeholder="What Am I Grateful For Today?" 
							required value="<?php echo $diary["thanks"] ; ?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10">
							<input type="text" name="motivasi" class="form-control" placeholder="My Quotes" 
							required value="<?php echo $diary["motivasi"] ?>">
						</div>
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-secondary">Save</button>
					</div>
				<br>
			</div>
	</div>
	<div  class="container panel" style="display:block; margin-top:20px; margin-left: auto; margin-right: auto; 
		width:60%;">
		<a href="index.php">
        <button class="btn btn-primary" type="button"> Back </button>
        </a>	
	</div>
</body>
</html>

<?php
function ubah_diary($data)
{
	global $db;
	
	// ambil data dari tiap elemen dalam form
	$id = $_GET["id"];
	$id_mood_fk =$data["id_mood_fk"];
	$story = htmlspecialchars($data["story"]);
    $thanks = htmlspecialchars($data["thanks"]);
    $motivasi = htmlspecialchars($data["motivasi"]);
	// query insert data
	mysqli_query($db, "CALL update_diary($id, '$story', '$thanks', '$motivasi', '$id_mood_fk')");

	return mysqli_affected_rows($db);
}
?>