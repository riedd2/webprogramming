<?php
print_r($_POST)?>

<div id="summary">
<h3>Order Summary: </h3>
	<div class="payment_shippment">
		<label  class="control-label"> Billing Method: </label> <?php $_POST['selectedPayment']?>
		<label  class="control-label"> Shipping Method: </label> <?php $_POST['selectedShippment']?>
	</div>
<?php if ($_POST['selectedShippment'] == 'mail'):?>
	<div class="shippingAddress">
		<label  class="control-label"> Billing E-Mail: </label> <?php $_POST['req_email']?> 
		<label	class="control-label"> Street Address: </label> <?php $_POST['req_address']?>
		<label class="control-label"> Zip Code: </label>  <?php $_POST['req_zip']?>
		<label class="control-label"> City: </label>  <?php $_POST['req_city']?>
		<label class="control-label"> Country: </label>  <?php $_POST['req_country']?>
		<label class="control-label"> Comment: </label>  <?php $_POST['req_comment']?>
	</div>
<?php endif ?>

	<?php if(isset($_SESSION['cart'])){
		$_SESSION['cart']->displayOrderSummary();
	}?>

</div>
