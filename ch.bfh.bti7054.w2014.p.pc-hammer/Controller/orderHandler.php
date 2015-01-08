<?php
include "/../class/dbconnector.inc.php";

//Handels the orders

if (isset ( $_GET ["ordersToSave"] )){
	$jsonString = $_GET ["ordersToSave"];
	$orders = json_decode($jsonString);	
	saveOrders($orders);
}

function saveOrders($ordersToSave){
	$db = new dbconnector();
	$result = $db->saveOrder($ordersToSave);
	if ($result > 0){
		echo "success";
	}else{
		echo "error";
	}	
}
?>
