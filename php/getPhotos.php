<?php

class response {
	public $status;
	public $data;
};

class photo {
	public $photo_id;
	public $city;
	public $country;
	public $date;
	public $caption;
	public $url;
	public $text;
};



$link = mysqli_connect('localhost', 'jfarrin1', 'temp')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'seniorsandnate') or die('Could not select database');
$resp = new response;
$resp->status = "connected";
$data = array();
$input = json_decode($_GET["id"]);

/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "SELECT P.photo_id, P.city, P.country, P.date, P.caption, P.url, posts.text FROM (select * from photos where fb_id = (select fb_id from users where id = ?)) P INNER JOIN posts ON P.fb_id = posts.fb_id AND P.city = posts.city;")) {
 /* bind parameters for markers */
 mysqli_stmt_bind_param($stmt, "i", $input);
 /* execute query */
 mysqli_stmt_execute($stmt);
/* bind result variables */
 mysqli_stmt_bind_result($stmt, $photo_id, $city, $country, $date, $caption, $url, $text);
 /* fetch values */
 while (mysqli_stmt_fetch($stmt)) {
	$temp = new photo;
	$temp->id = $photo_id;
	$temp->city = $city;
	$temp->country = $country;
	$temp->date = $date;
	$temp->caption = $caption;
	$temp->url = $url;
	$temp->text = $text;
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
