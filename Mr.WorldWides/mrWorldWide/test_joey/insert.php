<?php
$servername = "localhost";
$username = "jcurci";
$password = "Yankees13552!";
$dbname = "seniorsandnate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_name = "";
$user_age = null;
$user_name = $_POST['name'];
$user_age = intval($_POST['age']);
$user_name = mysqli_real_escape_string($conn,$user_name);

$sql = "INSERT INTO users (name, age) VALUES ('$user_name','$user_age')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
