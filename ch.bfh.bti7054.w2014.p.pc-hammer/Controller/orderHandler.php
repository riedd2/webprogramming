<?php
require_once "../class/cart.inc.php";

if (isset ( $_GET ["ordersToSave"] )){
	$jsonString = $_GET ["ordersToSave"];
	$orders = json_decode($jsonString);
	
	
}




?>