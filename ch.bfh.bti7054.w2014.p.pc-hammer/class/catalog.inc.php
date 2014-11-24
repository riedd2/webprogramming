<?php
class catalog{
	public $products = [
			
	];
	
	public $categories = [
			"hdd",
			"mainboard"
	];
	
	function __construct(){
		$this->getProductsFromDB();
	}
	
	function getProductsFromDB(){
		
		$this->products[1] = $this->setProduct("hdd1", 10, $this->categories[0]);
		$this->products[2] = $this->setProduct("hdd2", 100, $this->categories[0]);
		$this->products[3] = $this->setProduct("mainboard1", 30, $this->categories[1]);
		$this->products[4] = $this->setProduct("mainboard2", 1000, $this->categories[1]);
	}
	
	function setProduct($name, $price, $type){
		$product = [
			"name" => $name,
			"price" => $price,
			"type" => $type
		];
		
		return $product;
	}
}