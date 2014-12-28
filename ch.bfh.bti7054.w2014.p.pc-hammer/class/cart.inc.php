<?php
class Cart {
	private $products = array ();
	private $productQuantity = array();
	
	public function addItem($art, $num) {
		
		$index = $art->id;
		if (! isset ($this->products[$index] )){
			$this->products [$index] = $art;
		}
		if(!isset($this->productQuantity[$index])){
			$this->productQuantity[$index] = $num;
		}
		else {
		$this->productQuantity[$index] += $num;
		}
		
	}
	
	public function removeItem($prodId) {
		if (isset ( $this->products [$prodId] )) {
				unset ( $this->productQuantity [$prodId] );
				unset ( $this->products [$prodId] );
			return true;
		}
	}
	
	public function changeQuantity($prodId, $num)
	{
		$quantity = $this->productQuantity[$prodId];
		//remove product from chart
		if($quantity + $num <= 0){
			$this->removeItem($prodId);
		}
		else{
			$this->productQuantity[$prodId] += $num;
		}
		
	}
	private function getTotalPriceforItem($prodId, $quantity)
	{
		$price = $this->products[$prodId]->price;
		return $price * $quantity;
	}
	
	private function getButtonHtml($prodId){
		$html =  "<button onClick='changeProduct(".$prodId.",1)'>+</button>";
		$html = $html."<button onClick='changeProduct(".$prodId.",-1)'>-</button>";
		$html = $html."<button onClick='changeProduct(".$prodId.",-2147483647)'>X</button>";
		return $html;
		
	}
	
	public function display() {
		$totalPrice = 0;
		echo "<table border=\"1\">";
		echo "<tr><th>Artikel</th><th>Anzahl</th><th>Preis</th><th></th></tr>";
		foreach ($this->products as $art ){
			$prodId = $art->id;
			$quantity = $this->productQuantity[$prodId];
			$price = $this->getTotalPriceforItem($prodId, $quantity);
			$totalPrice+= $price;
			echo "<tr><td>".$art->name."</td><td>".$quantity."</td><td>".$price."</td><td>".$this->getButtonHtml($prodId)."</td></tr>";
		}
		echo "<tr><td> <b> Total </b></td><td><td><b>".$totalPrice."</b></td></tr>";
		echo "</table>";
	}
}
?>
