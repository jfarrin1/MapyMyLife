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
$text= $_GET["text"];
$date = $_GET["date"];
$city = $_GET["city"];
$country = $_GET["country"];
$lat = $_GET["lat"];
$lng = $_GET["lng"];
array_push($data, $user_id, $text, $date, $city, $country, $lat, $lng);
$resp->data = $data;
/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "INSERT INTO posts (fb_id, text, date, city, country, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?);")) {
 /* execute query */
 mysqli_stmt_bind_param($stmt, "sssssdd", $user_id, $text, $date, $city, $country, $lat, $lng);
 /* bind parameters for markers */
 mysqli_stmt_execute($stmt);
echo json_encode($resp);
 /* close statement */
 mysqli_stmt_close($stmt);
}
/* close connection */
mysqli_close($link);
?>
