<?php

class response {
	public $status;
	public $data;
};

class post {
	public $fb_id;
	public $text;
	public $date;
	public $city;
	public $country;
	public $lat;
	public $lng;
	public $post_id;
};



$link = mysqli_connect('localhost', 'jfarrin1', 'temp')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'seniorsandnate') or die('Could not select database');
$resp = new response;
$resp->status = "connected";
$data = array();
$fb_id = $_GET["fb_id"];

/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "SELECT fb_id, text, date, city, country, lat, lng, post_id FROM posts where fb_id = ?")) {
 /* bind parameters for markers */
 mysqli_stmt_bind_param($stmt, "s", $fb_id);
 /* execute query */
 mysqli_stmt_execute($stmt);
/* bind result variables */
 mysqli_stmt_bind_result($stmt, $id, $text, $date, $city, $country, $lat, $lng, $post_id);
 /* fetch values */
 while (mysqli_stmt_fetch($stmt)) {
	$temp = new post;
	$temp->fb_id = $id;
	$temp->text = $text;
	$temp->date = $date;
	$temp->city = $city;
	$temp->country = $country;
	$temp->lat = $lat;
	$temp->lng = $lng;
	$temp->post_id = $post_id;
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
