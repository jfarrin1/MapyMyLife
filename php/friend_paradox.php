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
$data = 0;
$fb_id = $_GET["fb_id"];

/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "select avg(G.x) from (select count(distinct city) as x from photos WHERE fb_id IN (select friend_id from friends where fb_id = ?) GROUP BY fb_id) G")) {
 /* bind parameters for markers */
 mysqli_stmt_bind_param($stmt, "s", $fb_id);
 /* execute query */
 mysqli_stmt_execute($stmt);
/* bind result variables */
 mysqli_stmt_bind_result($stmt, $avg);
 /* fetch values */
 mysqli_stmt_fetch($stmt);
 $data = $avg;
}
$resp->data = $data;
echo json_encode($resp);
 /* close statement */
 mysqli_stmt_close($stmt);

/* close connection */
mysqli_close($link);
?>
