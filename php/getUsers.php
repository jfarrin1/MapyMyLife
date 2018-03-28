<?php

class response {
	public $status;
	public $data;
};

class user {
	public $id;
	public $name;
	public $email;
};



$link = mysqli_connect('localhost', 'jfarrin1', 'temp')
 or die('Could not connect: ' . mysql_error());
mysqli_select_db($link, 'seniorsandnate') or die('Could not select database');
$resp = new response;
$resp->status = "connected";
$data = array();
//$input = json_decode($_GET["age"]);

/* create a prepared statement */
if ($stmt = mysqli_prepare($link, "SELECT id, name, age, email FROM users")) {
 /* bind parameters for markers */
// mysqli_stmt_bind_param($stmt, "i", $input);
 /* execute query */
 mysqli_stmt_execute($stmt);
/* bind result variables */
 mysqli_stmt_bind_result($stmt, $id, $name, $age, $email);
 /* fetch values */
 while (mysqli_stmt_fetch($stmt)) {
	$temp = new user;
	$temp->id = $id;
	$temp->name = $name;
	$temp->email = $email;
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
