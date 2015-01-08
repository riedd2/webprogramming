<?php 
session_start();
session_unset(); // ... delete all session variables,
session_destroy(); // ... and end it
   
//build url and redirect
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$i = strpos($url,"Controller");
$url = substr($url,0,$i);
$url .="index.php";

//redirect to index
header('Location: ' . $url, true, 303);
die();
?>
