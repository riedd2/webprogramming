<?php
echo "<h1>".$lang['hometitle']."</h1>";
echo "<h3>".$lang['weathertitle']."</h3>";
$client = new SoapClient("http://www.webservicex.com/globalweather.asmx?wsdl", array("trace" => 1, "exception" => 0, "features"=>SOAP_SINGLE_ELEMENT_ARRAYS));

$params = array(
		"CountryName" => "Switzerland",
		"CityName" => "Bern"
);

$result = $client->__soapCall("GetWeather", array($params));
echo $result->GetWeatherResult->location;
echo "<pre>".print_r($result, true)."</pre>";

//http://www.service-repository.com/operation/show?operation=GetWeather&portType=GlobalWeatherSoap&id=4
//$res = $client->GetWeather($params);
//echo $res->GetWeatherResponse->GetWeatherResult;

?>