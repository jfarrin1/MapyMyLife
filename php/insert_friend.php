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
$user_id = $_GET["user_id"];
$friend_id = $_GET["friend_id"];
array_push($data, $user_id);
array_push($data, $friend_id);
$resp->data = $data;
/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "INSERT INTO friends (fb_id, friend_id) SELECT ?, ? FROM friends WHERE NOT EXISTS (SELECT fb_id FROM friends WHERE fb_id = ? AND friend_id = ?) LIMIT 1")) {
 /* execute query */
 mysqli_stmt_bind_param($stmt, "ssss", $user_id, $friend_id, $user_id, $friend_id);
 /* bind parameters for markers */
 mysqli_stmt_execute($stmt);
echo json_encode($resp);
 /* close statement */
 mysqli_stmt_close($stmt);
}
/* close connection */
mysqli_close($link);
?>
