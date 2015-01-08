<?php
if (isset ( $_GET ["sessionToDestroy"] )){
	session_start();
	$session = $_GET ["sessionToDestroy"];
	unset($_SESSION[$session]);	
}
?>