<?php
require_once $_SERVER['DOCUMENT_ROOT']."/webprogramming/ch.bfh.bti7054.w2014.p.pc-hammer/class/cart.inc.php";
if(!isset($_SESSION)) session_start();

if (! isset ( $_SESSION ["cart"] ))
	$_SESSION ["cart"] = new Cart ();
if (isset ( $_GET ["art"] ) && isset ( $_GET ["num"] )){
	$_SESSION ["cart"]->addItem ( $_GET ["art"], $_GET ["num"] );
	}
echo $_SESSION["cart"]->display()

?>