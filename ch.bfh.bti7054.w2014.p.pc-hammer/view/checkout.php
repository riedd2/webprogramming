<html>
<head>
<style type="text/css">
.redborder { border: 1px solid red; }
</style>
<script type="text/javascript">

function setHiddenValue(id,val){
	document.getElementById(id).value = val;
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

function validate()
{
	if(areMethodesSelected())
	{
		if(document.getElementById("mail").checked)
		{
			return validateForm();
		}

		return true;
	}

	return false;
}

function areMethodesSelected()
{
	if(!areRadioButtonsChecked("delivery")){
		alert("Please select Shippment Methode");
		return false;
	}
	
	if(!areRadioButtonsChecked("payment")){
		alert("Please select Payment Methode");
		return false;
	}

	return true;
}

function validateForm(){

	
	var success = true;
	//Check billing and shipping

	//Get all components from form and check if the requiret ones are filled
	var comps = document.querySelectorAll('.formElement');
	//comps.push(document.querySelectorAll('option:checked'));
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
<h2><?php echo $lang['paymentshipping']?></h2>
<br>
<h4><?php echo $lang['shippmenttype']?></h4>
<div name="shippmentSelction">
<input type="radio" name="delivery" id="mail" value="mail" onclick="hideAddressForm('mail')"> <?php echo $lang['mail']?> <br>
<input type="radio" name="delivery" id="mail" value="pickup" onclick="hideAddressForm('pickup')"> <?php echo $lang['pickup']?> <br>
</div>

<h4><?php echo $lang['paymentmethod']?></h4>
<div name="paymentSelction">
<input type="radio" name="payment" value="bill" onclick="setHiddenValue('selectedPayment','bill')"> <?php echo $lang['bill']?> <br>
<input type="radio" name="payment" value="paypal" onclick="setHiddenValue('selectedPayment','paypal')"> <?php echo $lang['paypal']?> <br>
</div>

<br>


	<div class="row">
        <div class="span8">
    		<form id="billingform" action="index.php?page=_confirmation" method="POST" class="form-horizontal" onsubmit="return validate()">
    		    			
    			<input type="hidden" id="selectedShippment" value="" name="selectedShippment">
    			<input  type="hidden" id="selectedPayment" value="" name="selectedPayment">
    			
    		<div class="container" id="addressForm" style="display: none">
    		<h4><?php echo $lang['shippmentbillingadress']?></h4>
    			<div class="control-group">
    				<label for="email" class="control-label">	
    					<?php echo $lang['billingemail']?>
    				</label>
    				<div class="controls">
    					<input name="formElement[0]" type="text" value="" class="formElement" id="req_email">
    				</div>
    			</div>
     
    			<div class="control-group error">
    				<label for="address" class="control-label">	
    					<?php echo $lang['streetaddress']?>
    				</label>
    				<div class="controls"><input name="formElement[1]" class="formElement" placeholder="Musterstreet 12" type="text" value="" id="req_address"><span class="help-inline"></span>
    				</div>
    			</div>
     
    			<div class="control-group">
    				<label for="zip" class="control-label">	
    					<?php echo $lang['zipcode']?>
    				</label>
    				<div class="controls"><input name="formElement[2]" class="formElement" type="text" value="" id="req_zip">
    				</div>
    			</div>
     
    			<div class="control-group">
    				<label for="city" class="control-label">	
    					<?php echo $lang['city']?>
    				</label>
    				<div class="controls"><input name="formElement[3]" class="formElement" type="text" value="" id="req_city">
    				</div>
    			</div>
    			
    			<div class="control-group">
    				<label for="country" class="control-label">	
    					<?php echo $lang['country']?>
    				</label>
    				<div class="controls">
    					<select name="formElement[4]" class="formElement" id="req_country">
    						<option value=""></option>
    						<option value="AU">Australia</option>
    						<option value="DE">Germany</option>
    						<option value="CH">Switzerland</option>
    					</select>
    				</div>
    			</div>
    			<label for="comment" class="control-label">	
    					<?php echo $lang['comment']?>
    				</label>
    			<textarea class="form-control" rows="3" name="formElement[5]" class="formElement" id="comment" style="width: 300px"></textarea>
    			

     		</div>	
    			<div class="form-actions">
    				<button type="submit" class="btn btn-large btn-primary" ><?php echo $lang['next']?></button>
    			</div>
    		</form>
    	</div> <!-- .span8 -->
	</div>

	


<?php else: ?>
	"no products in chart"
<?php endif ?>

</body>
</html>
