<?php
$admin = new admin();
if (isset ( $_GET ["type"] )){
	$admin->type = $_GET ["type"];
	$admin->showForm();
}