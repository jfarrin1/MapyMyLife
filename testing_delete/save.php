<?php
$servername = "localhost";
$username = "nrao";
$password = "697280Human96%"
$dbname = "seniorsandnate";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_error){
	die("Connection failed: " . $conn -> connect_error;
}

$id = $_GET["uid"];

$sql = "DELETE FROM users WHERE userId = $id";

if (mysqli_query($conn, $sql)){
	echo "Record deleted.";
}
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
