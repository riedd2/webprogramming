<html>
<head>
<style type="text/css">
.redborder { border: 1px solid red; }
</style>
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

function addErrorMessage(id)
{
	var errorClass = " redborder";
	document.getElementById(id).className += errorClass;
}

function removeErrorMessage(id)
{
	var errorClass = " redborder";
	document.getElementById(id).className = document.getElementById(id).className.replace(errorClass," ");
}

function areRadioButtonsChecked(grpName) {
	  // All <input> tags...
	  var radios = document.getElementsByName(grpName);
	  for (var i=0; i<radios.length; i++) {
	    if (radios[i].type == 'radio' && radios[i].checked) {
	      return true;
	    } 
	  }
	  // End of the loop, return false
	  return false;
	}

function checkIfSpecialCtrlOk(id){

	switch(id) {
    case "req_email":
        var email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var email = document.getElementById(id).value;
        return email_regex.test(email);
        break;
        
    case "req_zip":
    	var zipcode_regex = /^\d{4}$/;
    	var zip = document.getElementById(id).value;
    	return zipcode_regex.test(zip);
        break;
    default:
        return true;
}
}

function validateForm(){

	
	var success = true;
	//Check billing and shipping
	if(!areRadioButtonsChecked("delivery")){
		alert("Please select Shippment Methode");
		success = false;
	}
	
	if(!areRadioButtonsChecked("payment")){
		alert("Please select Payment Methode");
		sucess = false;
	}
	
	//Get all components from form and check if the requiret ones are filled
	var comps = document.getElementsByName("formElement");
	for(i = 0; i < comps.length; i++)
	{
		if(isRequiret(comps[i].id)){
			if(!comps[i].value)
			{
				addErrorMessage(comps[i].id)
				success = false;
				continue;
			}
			if(!checkIfSpecialCtrlOk(comps[i].id)){
				addErrorMessage(comps[i].id)
				success = false;
				continue;
			}

			removeErrorMessage(comps[i].id);
		}
		removeErrorMessage(comps[i].id);
	}

	return success;
	
}

function isRequiret(ctrlId)
{
	var target = "req_";
	return ctrlId.substring(0, target.length) === target;
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


	<div class="row">
        <div class="span8">
    		<form id="billingform" action="view/confirmationPage.php" method="POST" class="form-horizontal" onsubmit="return validateForm()">
    		<div class="container" id="addressForm" style="display: none">
    		<h4>Shippment / Billing address:</h4>
    			<div class="control-group">
    				<label for="email" class="control-label">	
    					Billing E-Mail 
    				</label>
    				<div class="controls">
    					<input name="formElement" type="text" value="" id="req_email">
    				</div>
    			</div>
     
    			<div class="control-group error">
    				<label for="address" class="control-label">	
    					Street Address
    				</label>
    				<div class="controls"><input name="formElement" placeholder="Musterstreet 12" type="text" value="" id="req_address"><span class="help-inline">  Street Name and number</span>
    				</div>
    			</div>
     
    			<div class="control-group">
    				<label for="zip" class="control-label">	
    					Zip Code
    				</label>
    				<div class="controls"><input name="formElement" type="text" value="" id="req_zip">
    				</div>
    			</div>
     
    			<div class="control-group">
    				<label for="city" class="control-label">	
    					City
    				</label>
    				<div class="controls"><input name="formElement" type="text" value="" id="req_city">
    				</div>
    			</div>
    			
    			<div class="control-group">
    				<label for="country" class="control-label">	
    					Country
    				</label>
    				<div class="controls">
    					<select name="formElement" id="req_country">
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
    			<textarea class="form-control" rows="3" name="formElement" id="comment" style="width: 300px"></textarea>
    			
    			<div id="hiddenFields" style="display: none">
    			<input type="hidden" id="selectedShippment" value="">
    			<input  type="hidden" id="selectedPayment" value="">
    			</div>
     		</div>	
    			<div class="form-actions">
    				<button type="submit" class="btn btn-large btn-primary" >Next</button>
    			</div>
    		</form>
    	</div> <!-- .span8 -->
	</div>

	


<?php else: ?>
	"no products in chart"
<?php endif ?>

</body>
</html>
