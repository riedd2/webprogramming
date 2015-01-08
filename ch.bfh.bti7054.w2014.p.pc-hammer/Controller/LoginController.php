<?php
$db = new dbconnector();
$res = false;

$username = "";
$password = "";

if (isset( $_POST ["user"] ) && isset( $_POST ["pw"] )) {
	$username = $_POST ["user"];
	$password = $_POST ["pw"];
	
	//check if correct user and password is entered
	$res = $db->checkUserPassword($username, $password);
	
	if ($res) {
		$_SESSION ["user"] = $_POST ["user"];
		$user = $_POST ["user"];
		return $user;
	}else{
		return NULL;
		exit ();
	}
}

if (! isset ( $_SESSION ["user"] )) {
	return NULL;
	exit ();
}
?>
