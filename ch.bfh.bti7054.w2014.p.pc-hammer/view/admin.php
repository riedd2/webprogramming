<?php
include "/../class/catalog.inc.php";
//überprüfen, ob user admin ist. wenn nicht, nach 2 sekunden auf index.php weiterleiten
if(!isset($_SESSION ["admin"])){
	echo "sorry no admin u are";
	header('Refresh: 2; URL=/index.php',true, 303);
	die();
}

$cat = new catalog();
$cats = $cat->categories;
echo "<select class='selectpicker' onchange='showForm()' id='typeSelector'>";
//kategorien anzeigen
echo "<option selected disabled>choose type</option>";
foreach ($cats as $c){
	echo "<option>".$c."</option>";
}
echo "</select>";
echo "Produkttyp <br />";
?>

<!-- 

Leeres Form, das mit ajax erstellt wird, wenn ein produkttyp ausgewählt wird
-->
<form action="index.php" method="get" id="insertForm">

</form>
	
<script type="text/javascript">

function showForm(){
	type = document.getElementById('typeSelector').value;
	if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); }else{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
	xmlhttp.open("GET","Controller/adminController.php?type="+type, true);
	xmlhttp.send();

	   xmlhttp.onreadystatechange=function() {
	        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	            var cords = document.getElementById("insertForm");
	            cords.innerHTML=xmlhttp.responseText;
	        }
	    }  
}
</script>
	

