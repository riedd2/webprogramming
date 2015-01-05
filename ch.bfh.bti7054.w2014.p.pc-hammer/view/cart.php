<html>
<head><script type="text/javascript">
function addToBasket(product, num)
{
	//replace back 
	product = product.replace('|', ' ');
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); }else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
	xmlhttp.open("GET","Controller/cartHandler.php?art="+product+"&num="+num, true);
	xmlhttp.send();

	   xmlhttp.onreadystatechange=function() {
	        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	            var cords = document.getElementById("cart");
	            cords.innerHTML=xmlhttp.responseText;
	        }
	    } 
}

function changeProduct(prodId,num)
{
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); }else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
	xmlhttp.open("GET","Controller/cartHandler.php?prodId="+prodId+"&num="+num, true);
	xmlhttp.send();

	   xmlhttp.onreadystatechange=function() {
	        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	            var cords = document.getElementById("cart");
	            cords.innerHTML=xmlhttp.responseText;
	        }
	    }  
}

</script></head>
<body>
	<h3>Shopping Cart:</h3>
	<div id="cart">
	<?php 
	if(isset ( $_SESSION ["cart"] )){
	$_SESSION["cart"]->display();
	} ?>
</div>

</body>
</html>