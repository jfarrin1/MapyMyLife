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
$user_id = $_GET["fb_id"];
$lat = $_GET["lat"];
$lng = $_GET["lng"];
$url = $_GET["url"];
$datetime = $_GET["datetime"];
$country = $_GET["country"];
$city = $_GET["city"];
$caption = null;
if (isset($_GET["caption"])){
	$caption = $_GET["caption"];
}
array_push($data, $lat, $lng, $city, $country, $caption);
$resp->data = $data;
/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "INSERT INTO photos (fb_id, lat, lng, url, date, country, city, caption) SELECT ?, ?, ?, ?, ?, ?, ?, ? FROM photos WHERE NOT EXISTS ( SELECT fb_id FROM photos WHERE fb_id = ? AND url = ?) LIMIT 1")) {
 /* execute query */
 mysqli_stmt_bind_param($stmt, "ssssssssss", $user_id, $lat, $lng, $url, $datetime, $country, $city, $caption, $user_id, $url);
 /* bind parameters for markers */
 mysqli_stmt_execute($stmt);
echo json_encode($resp);
 /* close statement */
 mysqli_stmt_close($stmt);
}
/* close connection */
mysqli_close($link);
?>
