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
$post_id = json_decode($_GET["post_id"]);
//$input = json_decode(file_get_contents('php://input'));
$resp->data = $post_id;
/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "DELETE FROM posts WHERE post_id = ?")) {
 /* bind parameters for markers */
 mysqli_stmt_bind_param($stmt, "i", $post_id);
 /* execute query */
 mysqli_stmt_execute($stmt);
// $resp->data = "record deleted";
echo json_encode($resp);
 /* close statement */
 mysqli_stmt_close($stmt);
}
/* close connection */
mysqli_close($link);
?>
