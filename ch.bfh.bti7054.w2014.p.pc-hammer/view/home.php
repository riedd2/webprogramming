<?php
echo "<h3>".$lang['weathertitle']."</h3>";



if(isset($_GET['location'])){
	$client = new SoapClient("http://www.webservicex.com/globalweather.asmx?wsdl", array("trace" => 1, "exception" => 0, "features"=>SOAP_SINGLE_ELEMENT_ARRAYS));
	
	$params = array(
			"CountryName" => "Switzerland",
			"CityName" => $_GET['location']
	);
	
	$result = $client->__soapCall("GetWeather", array($params));
	

	if($result->GetWeatherResult != "Data Not Found"){
		
		$xml = simplexml_load_string(preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $result->GetWeatherResult));
		//for debugging
		//var_dump($xml);
		
		$loc =  (string)$xml->Location;
		$sky = (string)$xml->SkyConditions;
		$tempe = (string)$xml->Temperature;
		$relhum = (string)$xml->RelativeHumidity;
		
		echo sprintf($lang['weatherreport'], $loc, $sky, $tempe, $relhum);
	}
	else{
		echo "sorry..";
	}
	

	?>
	<br />
	<form action="index.php" method="get">
	<button type="submit" class="btn btn-default btn-lg"><?php  echo $lang["back"];?></button>
	</form>
	<?php 
}else{
	
// 	for performance reasons deactivated
// 	so a hard coded arry must do it
	
	
// 	$client = new SoapClient("http://www.webservicex.com/globalweather.asmx?wsdl", array("trace" => 1, "exception" => 0, "features"=>SOAP_SINGLE_ELEMENT_ARRAYS));
// 	$params = array(
// 			"CountryName" => "Switzerland"
// 	);
// 	$result = $client->__soapCall("GetCitiesByCountry", array($params));
// 	$xml = simplexml_load_string(preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $result->GetCitiesByCountryResult));
	
	$cities = [
			"Geneve-Cointrin",
			"Lausanne",
			"Neuchatel",
			"Sion",
			"Payerne",
			"Lugano",
			"Bern / Belp",
			"Grenchen",
			"Zurich-Kloten",
			"Saint Gallen-Altenrhein"
	]
	
	
?>
	<form action="index.php" method="get">
		<?php 
		echo $lang['selectCity'];?>
		<select class="selectpicker" name="location" onChange="this.form.submit()">
		<option disabled selected="selected"><?php echo $lang['pleaseselect']?></option>
	    <?php 
	    foreach($cities as $c){
	    	echo "<option>".$c."</option>";
	    }
	    ?>
	 	</select>
	</form>
<?php 
}

?>