<?php
if(!isset($_SESSION ["admin"])){
	echo "sorry no admin u are";
	header('Refresh: 5; URL=/index.php',true, 303);
	die();
}
echo "hello";
?>