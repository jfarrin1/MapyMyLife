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
$user_name = "";
$user_age = null;
$user_id = null;
$user_name = $_POST['name'];
$user_age = intval($_POST['age']);
$user_id = intval($_POST['id']);
$user_name = mysqli_real_escape_string($conn, $user_name);

$sql = "UPDATE users SET name = '$user_name', age = '$user_age' WHERE id = '$user_id')";

if (mysqli_query($conn, $sql)) {
	echo "Update successful";
} 
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
