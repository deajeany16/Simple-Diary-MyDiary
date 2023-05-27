<?php
require 'function.php';
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginpage.html');
}

$dairyy = query("SELECT * FROM diary JOIN mood ON diary.id_mood_fk=mood.id_mood");

if(isset($_POST["cari"])){
    $diaryy = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My List Diary</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top:20px;" >
        <form action="" method="POST">
            <div class="form-group row" >
                <div class="col-sm-6">
                    <input type="text" name="keyword" id="keyword" placeholder="Search..." 
                    class="form-control" autofocus autocomplete="off">
                </div>
                <button class="btn btn-secondary" type="submit" name="cari" id="cari">Search</button>
            </div>
        </form>

        <div class="panel-body">
            <a href="home.php">
                <button class="btn btn-primary" type="button"> Back </button>
            </a>
        </div>
        <br>

        <div class="panel panel-default" >
            <?php 
            foreach ($dairyy as $row) : 
            ?>
                <div class="panel-heading post-thumb">
                    <h3>My Diarys Today</h3>
                </div>
                <div class="panel-body post-body" id="container">
                    <table>
                        <tr class="col-sm-10">
                            <td> 
                                <label>Date :</label>
                                <?php echo $row["date"]; ?>
                            </td>
                        </tr>
                        <tr class="col-sm-10">
                            <td> 
                                <label>My Mood : </label>
                                <?php echo $row["mood"]; ?>
                            </td>
                        </tr>
                        <tr class="col-sm-10">
                            <td> 
                                <label>My Story : </label>
                                <?php echo $row["story"]; ?>
                            </td>
                        </tr>
                        <tr class="col-sm-10">
                            <td> 
                                <label>I am Grateful For : </label>
                                <?php echo $row["thanks"]; ?>
                            </td>
                        </tr>
                        <tr class="col-sm-10">
                            <td> 
                                <label>Quotes : </label>
                                <?php echo $row["motivasi"]; ?>
                            </td>
                        </tr>
                        <tr class="col-sm-10">
                            <td> 
                                <label>Reminder : </label>
                                <?php echo $row["message"]; ?>
                            </td>
                        </tr>
                        <tr class="col-sm-10">
                            <td>
                                <br>
                                <a href="edit.php?id=<?php echo $row['id_diary']; ?>">
                                    <button class="btn btn-primary" type="button"> Edit </button>
                                </a>
                                <a href="hapus.php?id=<?php echo $row['id_diary']; ?>">
                                    <button class="btn btn-danger" type="button"> Delete </button>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
                <br>
                <?php endforeach; ?>
        </div>
</body>
</html>