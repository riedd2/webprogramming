<?php
require_once "../class/cart.inc.php";
if(!isset($_SESSION)) session_start();

if (! isset ( $_SESSION ["cart"] ))
	$_SESSION ["cart"] = new Cart ();

if (isset ( $_GET ["art"] ) && isset ( $_GET ["num"] )){
	$jsonString = $_GET ["art"];
	$article = json_decode($jsonString);
	$_SESSION ["cart"]->addItem ( $article, $_GET ["num"] );		
	}

if (isset ( $_GET ["prodId"] ) && isset ( $_GET ["num"] )){
	//Remove or Add Product
	$prodId = $_GET ["prodId"];
	$num = $_GET ["num"];
	$_SESSION ["cart"]->changeQuantity($prodId,$num);
	}
echo $_SESSION["cart"]->display()

?>