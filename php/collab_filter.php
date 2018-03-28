<?php

class response {
	public $status;
	public $data;
};

class collab {
	public $fb_id;
	public $city;
};



$link = mysqli_connect('localhost', 'jfarrin1', 'temp')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'seniorsandnate') or die('Could not select database');
$resp = new response;
$resp->status = "connected";
$data = array();
$fb_id = $_GET["fb_id"];

/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "SELECT DISTINCT p.fb_id, p.city FROM photos p WHERE p.fb_id IN (select distinct f.friend_id from friends f where f.fb_id = ?)")) {
 /* bind parameters for markers */
 mysqli_stmt_bind_param($stmt, "s", $fb_id);
 /* execute query */
 mysqli_stmt_execute($stmt);
/* bind result variables */
 mysqli_stmt_bind_result($stmt, $id, $city);
 /* fetch values */
 while (mysqli_stmt_fetch($stmt)) {
	$temp = new collab;
	$temp->fb_id = $id;
	$temp->city = $city;
	array_push($data, $temp); 
}
$resp->data = $data;
echo json_encode($resp);
 /* close statement */
 mysqli_stmt_close($stmt);
}
/* close connection */
mysqli_close($link);
?>
