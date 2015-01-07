<html>
<body>
<?php if (isset($_SESSION ["cart"])):?>
<h3> Order Summary </h3>
 <?php $_SESSION["cart"]->displayOrderSummary(); ?>

	
	


<?php else: ?>
	"no products in chart"
<?php endif ?>

</body>
</html>
