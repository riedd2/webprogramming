<?php
class catalog{
	
	public $db;
	public $products = [
			
	];
	//better as enumerator
	public $categories = [
			
	];
	
	function __autoload($class_name) {
		include 'class\\'. $class_name . '.inc.php';
	}
	
	
	function __construct(){
		$this->getCategoriesFromDB();
		$this->getProductsFromDB();
		
		
	}
	
	function getCategoriesFromDB(){
		$db = new dbconnector();
		$db->setQuery("SELECT * FROM category");
	
		$res = $db->queryDB();
		while($row = $res->fetch_assoc()){
			$this->categories[$row['id_category']] = $row['categoryname'];
		}
	}
	
	
	function getProductsFromDB(){
		$db = new dbconnector();
		$join = "SELECT *
			FROM product as p left join category as c
			on p.category_id= c.id_category
			order by id_product";
		
		$db->setQuery($join);
		$res = $db->queryDB();
		
		while($row = $res->fetch_assoc()){
			$this->products[$row['id_product']] = $this->setProduct($row['id_product'],$row['name'], $row['price'], $this->categories[$row['id_category']]);
		}
	}
	
	function setProduct($id, $name, $price, $type){
		$product = [
			"id" => $id,
			"name" => $name,
			"price" => $price,
			"type" => $type
		];
		
		return $product;
	}
}