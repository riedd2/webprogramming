<?php
//hier wird autoload function von index nicht aufgerufen. wieso?
require '../class/dbconnector.inc.php';
require '../class/admin.inc.php';
$admin = new admin();
if (isset ( $_GET ["type"] )){
	$admin->type = $_GET ["type"];
	$admin->showForm();
}


