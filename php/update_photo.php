<?php
$servername = "localhost";
$username = "jfarrin1";
$password = "temp";
$dbname = "seniorsandnate";

// Make da connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check da connection
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$photo_uid = null;
$photo_location = null;
$photo_date = null;
$photo_url = null;

$photo_uid = intval($_POST['photo_uid']);
$photo_location = $_POST['photo_loc'];
$photo_date = $_POST['photo_date'];
$photo_url = $_POST['photo_url'];

$photo_location = mysqli_real_escape_string($conn, $photo_location);
$photo_url = mysqli_real_escape_string($conn, $photo_url);
$photo_date = mysqli_real_escape_string($conn, $photo_date);
$photo_date = date($photo_date);


$sql = "REPLACE INTO photos (user_id, location, url, date) VALUES ('$photo_uid', '$photo_location', '$photo_url', '$photo_date')";

if (mysqli_query($conn, $sql)) {
	echo "Update successful";
} 
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
