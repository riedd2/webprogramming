<?php
include "/../class/catalog.inc.php";
//überprüfen, ob user admin ist. wenn nicht, nach 2 sekunden auf index.php weiterleiten
if(!isset($_SESSION ["admin"])){
	echo "sorry no admin u are";
	header('Refresh: 2; URL=/index.php',true, 303);
	die();
}
?>

<form action="index.php" method="GET">
<?php echo $lang['username']?>: <input type="text" name="username"/><br />
<?php echo $lang['password']?>: <input type="text" name="password"/><br />
<?php echo $lang['email']?>: <input type="text" name="email"/><br />
<?php echo $lang['adminmenu']?>: <select name="admin">
<option>0</option>
<option>1</option>
</select><br />
<button class ="btn btn-default" ><?php echo $lang['confirm']?></button><br />
<input type='textbox' hidden name='page' value='_admin'/>
</form>


<?php 
if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['email']) && isset($_GET['admin'])){
	if($_GET['username'] != "" && $_GET['password'] != "" && $_GET['email'] != "" && $_GET['admin'] != ""){
		$user = $_GET['username'];
		$email = $_GET['email'];
		$password = $_GET['password'];
		$admin = $_GET['admin'];
		$db = new dbconnector();
		$query = "INSERT INTO `pchammer`.`user` (`username`, `email`, `password`, `admin`) VALUES ('%s', '%s', '%s', '%d');";
		$query = sprintf($query, $user, $email, $password, $admin);
		$db->setQuery($query);
		if($db->queryDB()){
			echo "<h3>".$lang['inserted']."</h3>";
		}else{
			echo "<h3>".$lang['notinserted']."</h3>";
		}
	}else{
		echo "<h3>".$lang['notinserted']."</h3>";
	}	
}

echo "<br /><br />	funktioniert noch nicht.. <br />";
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
	

