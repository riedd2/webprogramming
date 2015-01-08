<html>
<head>
<script type="text/javascript">

function confirmOrder(){
	if(confirm("Are you sure you want to confirm? You are going to enter a binding contract"))
	{
		
	}
	else{
	}
}


</script>
</head>
<div id="summary">
<h2>Order Summary: </h2>
	<div class="payment_shippment">
		<label  class="control-label"> Billing Method: </label> <?php echo $_POST['selectedPayment'];?> <br>
		<label  class="control-label"> Shipping Method: </label> <?php echo $_POST['selectedShippment'];?>
	</div>
<?php if ($_POST['selectedShippment'] == 'mail'):?>
	<div class="shippingAddress">
		<label  class="control-label"> Billing E-Mail: </label> <?php echo $_POST['formElement'][0];?> <br>
		<label	class="control-label"> Street Address: </label> <?php echo $_POST['formElement'][1];?> <br>
		<label class="control-label"> Zip Code: </label>  <?php echo $_POST['formElement'][2];?> <br>
		<label class="control-label"> City: </label>  <?php echo $_POST['formElement'][3];?> <br>
		<label class="control-label"> Country: </label>  <?php echo $_POST['formElement'][4];?> <br>
		<label class="control-label"> Comment: </label>  <?php echo $_POST['formElement'][5];?> <br>
	</div>
<?php endif ?>

<div id="orderedProducts">
<br>
<h3>Products:</h3>
	<br>
	<?php 
		$_SESSION["cart"]->displayOrderSummary(); 
	?>
</div>

<button name="confirm" onclick="confirmOrder()">Confirm Order</button>
</div>
</html>