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
$id = $_GET["id"];
array_push($data, $id);
$resp->data = $data;
/* create a prepared statement */
$sql = "DELETE FROM photos where fb_id = (select fb_id from users where id = $id);";
$sql .="DELETE FROM posts where fb_id = (select fb_id from users where id = $id);";
$sql .= "Delete FROM users where id = $id;";
mysqli_multi_query($link, $sql);
echo json_encode($resp);
/* close connection */
mysqli_close($link);
?>
