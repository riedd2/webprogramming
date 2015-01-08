<?php
include "/../class/dbconnector.inc.php";
if (isset ( $_GET ["ordersToSave"] )){
	$jsonString = $_GET ["ordersToSave"];
	$orders = json_decode($jsonString);
	var_dump($orders);
	
	return saveOrders($orders);

}

function saveOrders($ordersToSave){
	$db = new dbconnector();
	$result = $db->saveOrder($ordersToSave);
	if ($result > 0){
		return "success";
	}
	return "error";
	
}




?>