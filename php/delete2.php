<?php
$servername = "localhost";
$username = "jfarrin1";
$password = "temp";
$dbname = "seniorsandnate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_POST['id']);
$sql = "DELETE from users WHERE id = $id";

if (mysqli_query($conn, $sql)) {
   $sql2 = "DELETE from photos WHERE fb_id = (select fb_id from users where id = $id)";
   $sql3 = "DELETE from posts WHERE fb_id = (select fb_id from users where id=$id)";
  mysqli_query($conn,$sql2);
  mysqli_query($conn,$sql3);

    echo "DELETED";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
