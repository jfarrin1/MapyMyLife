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

$post_uid = null;
$post_location = null;
$post_date = null;
$post_text = null;

$post_uid = intval($_POST['post_uid']);
$post_location = $_POST['post_loc'];
$post_date = $_POST['post_date'];
$post_text = $_POST['post_text'];

$post_location = mysqli_real_escape_string($conn, $post_location);
$post_text = mysqli_real_escape_string($conn, $post_text);
$post_date = mysqli_real_escape_string($conn, $post_date);
$post_date = date($post_date);


$sql = "REPLACE INTO posts (user_id, location, text, date) VALUES ('$post_uid', '$post_location', '$post_text', '$post_date')";

if (mysqli_query($conn, $sql)) {
	echo "Update successful";
} 
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
