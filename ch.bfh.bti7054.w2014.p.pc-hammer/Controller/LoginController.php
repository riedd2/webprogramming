<?php
$db = new dbconnector();

$res = false;

$username = "";
$password = "";
if (isset( $_POST ["user"] ) && isset( $_POST ["pw"] )) {
	$username = $_POST ["user"];
	$password = $_POST ["pw"];
	$res = $db->checkUserPassword($username, $password);
}


if (isset( $_POST ["user"] )) {
	if ($res) {
		$_SESSION ["user"] = $_POST ["user"];
		$user = $_POST ["user"];
		return $user;
	}
}
if (! isset ( $_SESSION ["user"] )) {
	return NULL;
	exit ();
}


?>
