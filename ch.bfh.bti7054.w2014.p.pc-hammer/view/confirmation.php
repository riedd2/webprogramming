<html>
<head>
<script type="text/javascript">

function saveOrder(product)
{
	//replace back 
	product = product.replace('|', ' ');
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); }else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
	xmlhttp.open("GET","Controller/orderHandler.php?ordersToSave="+product, true);
	xmlhttp.send();

	   xmlhttp.onreadystatechange=function() {
	        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	          $("#" + xmlhttp.responseText).show();  
	          if(xmlhttp.responseText == "success")
	          {
		          var url = document.URL;
		          var i = url.indexOf("?");
		          url = url.substring(0,i);
		          destroySession("cart");
		          window.setTimeout(function(){
		              window.location.href = url;
		          }, 3000);
	          } 
	          
	        }
	       }
	    $("#summary").hide(); 
}

function confirmOrder(product){
	if(confirm("Are you sure you want to confirm? You are going to enter a binding contract"))
	{
		saveOrder(product)
	}

}

function destroySession(sessionName)
{
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); }else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
	xmlhttp.open("GET","Controller/sessionHandler.php?sessionToDestroy="+sessionName, true);
	xmlhttp.send();
	
}

</script>
</head>
<div id="summary">
<h2>Order Summary: </h2>
	<div class="payment_shippment">
		<label  class="control-label"> <?php echo $lang['paymentmethod']?>: </label> <?php echo $lang[$_POST['selectedPayment']];?> <br>
		<label  class="control-label"> <?php echo $lang['shippmenttype']?>: </label> <?php echo $lang[$_POST['selectedShippment']];?>
	</div>
<?php if ($_POST['selectedShippment'] == 'mail'):?>
	<div class="shippingAddress">
		<label  class="control-label"> <?php echo $lang['billingemail']?>: </label> <?php echo $_POST['formElement'][0];?> <br>
		<label	class="control-label"> <?php echo $lang['streetaddress']?>: </label> <?php echo $_POST['formElement'][1];?> <br>
		<label class="control-label"> <?php echo $lang['zipcode']?>: </label>  <?php echo $_POST['formElement'][2];?> <br>
		<label class="control-label"> <?php echo $lang['city']?>: </label>  <?php echo $_POST['formElement'][3];?> <br>
		<label class="control-label"> <?php echo $lang['country']?>: </label>  <?php echo $_POST['formElement'][4];?> <br>
		<label class="control-label"> <?php echo $lang['comment']?>: </label>  <?php echo $_POST['formElement'][5];?> <br>
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
<?php 
$jsonstr = "'".json_encode($_SESSION["cart"]->getProductQuantity())."'";




echo "<button name='confirm' onclick="."confirmOrder($jsonstr)".">".$lang['confirmorder']."</button>"

?>
</div>

<div id="success" class="alert alert-success" style="display: none">
  Order has been saved
</div>

<div id="error" class="alert alert-block" style="display: none">
  Something went wrong with the order
</div>
</html>
