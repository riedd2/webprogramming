<?php
if (isset($_SESSION ["cart"])){
	echo "<h3> Order Summary </h3>";
	$_SESSION["cart"]->displayOrderSummary();
	
}
else{
	echo "no products in chart";
}
	
	
	
	
		?>
