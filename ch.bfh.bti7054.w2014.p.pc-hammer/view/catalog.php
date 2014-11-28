<?php
function __autoload($class_name) {
	include 'class\\'. $class_name . '.inc.php';
}

$cat = new catalog();

$products = $cat->products;
$categories = $cat->categories;
$onlyHDD = false;
$onlyMainboard = false;
$filter = "none";


//filter with input box
if(isset($_GET['filter'])){
	$filter = $_GET['filter'];
	if($filter == 'hdd'){
		$onlyHDD = true;
	}else if($filter == 'mainboard'){
		$onlyMainboard = true;
	}
	else{
		$onlyHDD = false;
		$onlyMainboard = false;
	}
	
	
}

//search for name
//filter with input box
if(isset($_GET['search']) && $_GET['search'] != ""){
	$searchquery = $_GET['search'];
}


//filter with type seleciton
echo "<form action='index.php' method='get' name='filterform'>";
for ($i = 0; $i <= sizeof($cat); $i++){
	echo $categories[$i];
	if($filter == $categories[$i]){
		echo "<input type='radio' name='filter' value='".$categories[$i]."'  checked />";
	}else{
		
		echo "<input type='radio' name='filter' value='".$categories[$i]."'  />";
	}
}
echo "<input type='textbox' hidden name='page' value='catalog'/>";
echo "<input type='submit' value='submit'/>";

echo '</form>';


//show products
$counter = 0; //counts if a product is found when searching
foreach ($products as $p){
	if(isset($searchquery)){
		if($p["name"] == $searchquery){
			$counter++;
			echo "<h1>".$p["name"]."</h1>";
			echo $p["price"];
			echo "</br>";
			echo $p["type"];
		}else{
			if($p["name"] == end($products)["name"] && $counter == 0){
				echo "Kein Produkt unter diesem Namen gefunden!";
			}
		}
	}else{	
		if($onlyHDD){
			if($p["type"] == "hdd"){
				echo "<h1>".$p["name"]."</h1>";
				echo $p["price"];
				echo "</br>";
				echo $p["type"];
			}
			
		}else if($onlyMainboard){
			if($p["type"] == "mainboard"){
				echo "<h1>".$p["name"]."</h1>";
				echo $p["price"];
				echo "</br>";
				echo $p["type"];
			}
			
		}else{
			echo "<h1>".$p["name"]."</h1>";
			echo $p["price"];
			echo "</br>";
			echo $p["type"];
		}
	}
}

?>
<p>
<form action="index.php" method="get">
 Filter: <input type="text" name="filter" /></br>
 <input type="submit" value="set filter" />
 <input type='textbox' hidden name='page' value='catalog'/>
 </form>
</p>

<p>
<form action="index.php" method="get">
 Search: <input type="text" name="search" /></br>
 <input type="submit" value="search a name" />
  <input type='textbox' hidden name='page' value='catalog'/>
 </form>
</p>

<p>
<form action="index.php" method="get">
 Search: <input hidden="true" type="text" name="reset" /></br>
 <input type="submit" value="reset" />
  <input type='textbox' hidden name='page' value='catalog'/>
 </form>
</p>



