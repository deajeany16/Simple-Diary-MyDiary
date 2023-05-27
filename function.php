<?php

$db = mysqli_connect("localhost", "root", "", "diary");
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}


function query($query)
{
	global $db;
	$username = $_SESSION['username'];
	$queryUser = "SELECT id_user FROM user WHERE username = '$username'";
    $resultUser = mysqli_query($db, $queryUser);

    if ($resultUser && mysqli_num_rows($resultUser) > 0) {
        $rowUser = mysqli_fetch_assoc($resultUser);
        $id_user = $rowUser['id_user'];

        // Mengubah query menjadi query yang hanya mencakup kolom data milik id_user yang sedang berjalan
        $query = "SELECT * FROM ($query) AS temp_table WHERE id_user = $id_user";

        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $rows = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }

            return $rows;
        } else {
			echo "Error: " . mysqli_error($db);
            return [];
        }
    } else {
        return [];
    }
}

function tambah_diary($data)
{
	global $db;
	// ambil data dari tiap elemen dalam form
	$story = htmlspecialchars($data["story"]);
    $thanks = htmlspecialchars($data["thanks"]);
	$motivasi = htmlspecialchars($data["motivasi"]);
	$id_mood_fk = $data["id_mood_fk"];
	$username = $_SESSION['username'];

	$getUserQuery = "SELECT id_user FROM user WHERE username = '$username'";
    $result = $db->query($getUserQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_user = $row['id_user'];
		// query insert data
		mysqli_query($db, "CALL insert_diary('$story', '$thanks', '$motivasi', '$id_mood_fk', '$id_user');");
	};

	return mysqli_affected_rows($db);
}

function hapus_diary($id)
{ 
	global $db;
	mysqli_query($db, "DELETE FROM diary WHERE id=$id");
	return mysqli_affected_rows($db);
}

function cari($keyword){
	$query = "SELECT * FROM diary JOIN mood ON mood.id_mood=diary.id_mood_fk 
			  WHERE story LIKE '%$keyword%' OR thanks LIKE '%$keyword%' 
			  OR motivasi LIKE '%$keyword%'
			  OR mood LIKE '%$keyword%'";

	return query($query);
}
?>