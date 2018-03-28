<?php

class response {
	public $status;
	public $data;
};


$link = mysqli_connect('localhost', 'jfarrin1', 'temp')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'seniorsandnate') or die('Could not select database');
$resp = new response;
$resp->status = "connected";
$data = array();
$name = $_GET["name"];
$email = $_GET["email"];
$fb_id = $_GET["fb_id"];
array_push($data, $name);
array_push($data, $email);
array_push($data, $fb_id);
$resp->data = $data;
/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "INSERT INTO users (name, email, fb_id) SELECT ?, ?, ? FROM users WHERE NOT EXISTS (SELECT fb_id FROM users WHERE fb_id = ?) LIMIT 1")) {
 /* execute query */
 mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $fb_id, $fb_id);
 /* bind parameters for markers */
 mysqli_stmt_execute($stmt);
echo json_encode($resp);
 /* close statement */
 mysqli_stmt_close($stmt);
}
/* close connection */
mysqli_close($link);
?>
