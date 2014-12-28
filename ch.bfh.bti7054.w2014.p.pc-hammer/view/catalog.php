<?php
$cat = new catalog();

$products = $cat->products;
$categories = $cat->categories;
$onlyHDD = false;
$onlyMainboard = false;
$filter = "";
$searchquery = "";

//filter with combo box
if(isset($_GET['filter'])){
	$filter = $_GET['filter'];
}

//search for name
if(isset($_GET['search']) && $_GET['search'] != ""){
	$searchquery = $_GET['search'];
}

//debug
echo "filter: " . $filter . "</br>";
echo "search: " . $searchquery;



//filter with type seleciton
echo "<div class='row'>";
	echo "<h3>Filter</h3>";
	echo "<form action='index.php' method='get' name='filterform'>";
	for ($i = 1; $i <= sizeof($categories); $i++){
		echo $categories[$i];
		if($filter == $categories[$i]){
			echo "<input type='radio' name='filter' value='".$categories[$i]."'  checked /></br>";
		}else{
			
			echo "<input type='radio' name='filter' value='".$categories[$i]."'  /></br>";
		}
	}
	echo "<input type='textbox' hidden name='page' value='catalog'/>";
	echo "</br>";
	echo "<input type='submit' value='submit'/>";
	
	echo '</form>';
echo "</div>";


//show products
$counter = 0; //counts if a product is found when searching
//
if($searchquery!= ""){
	$results = checkMatch($products, $searchquery);
	foreach ($results as $p){
		showProduct($p);
	}
}else if($filter != ""){
	foreach ($products as $p){
		if($p["type"] == $filter){
			$counter++;
			showProduct($p);
		}else if($p["name"] == end($products)["name"] && $counter == 0){
			echo "Kein Produkt unter diesem Namen gefunden!";
		}else{
			//no match
		}
	}
}else{
	foreach ($products as $p){
		showProduct($p);
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
 Reset: <input hidden="true" type="text" name="reset" /></br>
 <input type="submit" value="reset" />
  <input type='textbox' hidden name='page' value='catalog'/>
 </form>
</p>


<?php 
function showProduct($p){
	
	$prodId = $p["id"];
	//Replace spaces with | because the browser is messing up the onclick statement
	$jsonString = "'".preg_replace('/\s+/', '|', json_encode($p))."'";
	$jsFunction = 'addToBasket('.$jsonString.',document.getElementById("'.$prodId.'").value)';

	echo "<div class='row'>";
	echo "<h1>".$p["name"]."</h1>";
	echo "<div class='col-xs-3 col-sm-3'>";
		echo "<img src='' width=100px height=100px />";	
	echo "</div>";
	echo "<div class='col-xs-6 col-sm-6'>";
		echo "<table class='table'>";
		echo "<tr><td>Preis</td><td>";
		echo $p["price"];
		echo "</td><tr>";
		echo "<tr><td>Typ</td><td>";
		echo $p["type"];
		echo "</tr><tr><td>";
		echo "<input type='text' width='40px' style='float: right' name='quantity' id='".$prodId."' value='1'/>";
		echo "<button onClick='increase(".$prodId.")'>+</button>";
		echo "<button onClick='decrease(".$prodId.")'>-</button>";
		echo "</td><td>";
		echo "<button class='btn btn-default' onclick=".$jsFunction.">In den Warenkorb</button></td></tr>";
		echo "</table>";
	echo "</div>";
	echo "</div class='row'>";
}

function checkMatch($products, $searchquery){
	//$pattern = '/' + $searchquery + '/';
	$matches = array();
	$pattern = "/".$searchquery."/i"; 
	//loop through the data
	foreach($products as $key=>$value){
	    //loop through each key under data sub array
	    foreach($value as $key2=>$value2){
	        //check for match.
	        if(preg_match($pattern, $value2)){
	            //add to matches array.
	            $matches[$key]=$value;
	            //match found, so break from foreach
	            break;
	        }
	    }
	}
	return $matches;
}
	
// 	//possible to give whole array and returns the array consisting of the elements of the input array preg_grep()
// 	$pattern = '/' + $searchquery + '/';

// 	preg_filter($pattern, $replace, $subject));
	

?>

<script type="text/javascript">
function increase(idd){
	document.getElementById(idd).value++;
} 

function decrease(idd){
	if(document.getElementById(idd).value <= 0)
		return;
	document.getElementById(idd).value--;
} 

</script>
<!--

//-->
</script>

