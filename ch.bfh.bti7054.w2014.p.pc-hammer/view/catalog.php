<?php
include "/../class/catalog.inc.php";
$cat = new catalog();
//get products
$products = $cat->products;
//get categories
$categories = $cat->categories;

//default values
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
// echo "filter: " . $filter . "</br>";
// echo "search: " . $searchquery;


//filter with type selection
echo "<div class='row'>";
	echo "<h3>".$lang['filter']."</h3>";
	echo "<form action='index.php' method='get' name='filterform'>";
	for ($i = 1; $i <= sizeof($categories); $i++){
		echo $lang[$categories[$i]];
		if($filter == $categories[$i]){
			echo "<input type='radio' name='filter' value='".$categories[$i]."'  checked onChange='this.form.submit()'/></br>";
		}else{
			
			echo "<input type='radio' name='filter' value='".$categories[$i]."' onChange='this.form.submit()'/></br>";
		}
	}
	?>
	<input type='textbox' hidden name='page' value='catalog'/>
	</form>
	<form action="index.php" method="get">
		<input hidden="true" type="text" name="reset" /></br>
 		<input type="submit" value="reset" />
  		<input type='textbox' hidden name='page' value='catalog'/>
 	</form>
</div>

<?php 
//show products
//counts how many products are found when searching
$counter = 0;

if($searchquery != ""){
	$results = checkMatch($products, $searchquery);
	foreach ($results as $p){
		showProduct($p, $lang, $imgpath, $GLOBALS['smarty']);
	}
}else if($filter != ""){
	foreach ($products as $p){
		if($p["type"] == $filter){
			$counter++;
			showProduct($p, $lang, $imgpath, $GLOBALS['smarty']);
		}else if($p["name"] == end($products)["name"] && $counter == 0){
			echo $lang['noproductfound'];
		}else{
			//no match
		}
	}
}else{
	foreach ($products as $p){
		showProduct($p, $lang, $imgpath, $smarty);
	}
}
 
function showProduct($p, $langarray, $imgpath, $smarty){
	$prodId = $p["id"];
	$lang = $langarray;
	//Replace spaces with | because the browser is messing up the onclick statement
	$jsonString = "'".preg_replace('/\s+/', '|', json_encode($p))."'";
	$jsFunction = "addToBasket(".$jsonString.",document.getElementById('".$prodId."').value)";

	$smarty->assign('name', $p["name"]);
	$smarty->assign('image', $p["image"]);
	$smarty->assign('langquantAvailable', $lang['quantAvailable']);
	$smarty->assign('quantAvailable', $p["quantAvailable"]);
	$smarty->assign('langprice', $lang['price']);
	$smarty->assign('price', $p["price"]);
	$smarty->assign('imgpath', $imgpath);
	$smarty->assign('langtype', $lang['type']);
	$smarty->assign('type', $lang[$p['type']]);
	$smarty->assign('prodid', $prodId);
	$smarty->assign('jsfunction', $jsFunction);
	$smarty->assign('langtocart', $lang['tocart']);
	
	$smarty->display('index.tpl');

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

?>

<script type="text/javascript">
function increase(idd, max){
	if(document.getElementById(idd).value < max){
		document.getElementById(idd).value++;
	}
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

