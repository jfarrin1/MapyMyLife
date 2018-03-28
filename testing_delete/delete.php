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
$input = json_decode($_GET["id"]);
//$input = json_decode(file_get_contents('php://input'));
$resp->data = $input;
/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "DELETE FROM users WHERE id = ?")) {
 /* bind parameters for markers */
 mysqli_stmt_bind_param($stmt, "i", $input);
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
