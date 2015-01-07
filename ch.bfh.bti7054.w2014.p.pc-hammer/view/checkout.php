<html>
<head>
<script type="text/javascript">

function setHiddenValue(id,val){
	document.getElementById(id).text = val;
}

function hideAddressForm(value){
		if(value == "pickup"){
		//hide with jquery
		$("#addressForm").hide();
		}
	else{
		 $("#addressForm").show();
		
	}

	//set the hidden value
	setHiddenValue("selectedShippment",value);
}


</script>
</head>
<body>
<?php if (isset($_SESSION ["cart"])):?>
<h2> Payment & Shippment </h2>
<!--   <?php $_SESSION["cart"]->displayOrderSummary(); ?>-->
<br>
<h4> Select shippment type </h4>
<div name="shippmentSelction">
<input type="radio" name="delivery" value="mail" onclick="hideAddressForm('mail')"> Mail <br>
<input type="radio" name="delivery" value="pickup" onclick="hideAddressForm('pickup')"> Pick-up at Store <br>
</div>

<h4> Select payment methode </h4>
<div name="paymentSelction">
<input type="radio" name="payment" value="bill" onclick="setHiddenValue('selectedPayment','bill')"> Bill <br>
<input type="radio" name="payment" value="paypal" onclick="setHiddenValue('selectedPayment','paypal')"> PayPal <br>
</div>

<br>

<h4>Shippment / Billing address:</h4>
	<div class="row">
        <div class="span8">
    		<form action="billing" method="post" class="form-horizontal" id="billingform" accept-charset="utf-8">
    		<div class="container" id="addressForm" style="display: none">
    			<div class="control-group">
    				<label for="email" class="control-label">	
    					Billing E-Mail 
    				</label>
    				<div class="controls">
    					<input name="email" type="email" value="" id="email">
    				</div>
    			</div>
     
    			<div class="control-group">
    				<label for="address" class="control-label">	
    					Street Address
    				</label>
    				<div class="controls"><input name="address" placeholder="Musterstreet 12" type="text" value="" id="address"><span class="help-inline">  Street Name and number</span>
    				</div>
    			</div>
     
    			<div class="control-group">
    				<label for="zip" class="control-label">	
    					Zip Code
    				</label>
    				<div class="controls"><input name="zip" type="text" value="" id="zip">
    				</div>
    			</div>
     
    			<div class="control-group">
    				<label for="city" class="control-label">	
    					City
    				</label>
    				<div class="controls"><input name="city" type="text" value="" id="city">
    				</div>
    			</div>
    			
    			<div class="control-group">
    				<label for="country" class="control-label">	
    					Country
    				</label>
    				<div class="controls">
    					<select name="country" id="country">
    						<option value=""></option>
    						<option value="AU">Australia</option>
    						<option value="DE">Germany</option>
    						<option value="CH">Switzerland</option>
    					</select>
    				</div>
    			</div>
    			<label for="comment" class="control-label">	
    					Comment
    				</label>
    			<textarea class="form-control" rows="3" name="comment" style="width: 300px"></textarea>
    			
    			<div id="hiddenFields" style="display: none">
    			<input id="selectedShippment"  type="text">
    			<input id="selectedPayment"  type="text">
    			</div>
     </div>	
    			<div class="form-actions">
    				<button type="submit" class="btn btn-large btn-primary">Next</button>
    			</div>
    		</form>
    	</div> <!-- .span8 -->
	</div>

	


<?php else: ?>
	"no products in chart"
<?php endif ?>

</body>
</html>
