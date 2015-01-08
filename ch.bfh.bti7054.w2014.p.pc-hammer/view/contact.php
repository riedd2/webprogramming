<?php
if (isset($_SESSION["cart"])){
	$productquantity = $_SESSION["cart"]->getProductQuantity();
	var_dump($productquantity);
	$db = new dbconnector();
	$db->saveOrder($productquantity);
}
?>