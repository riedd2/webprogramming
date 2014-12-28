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
	
	public function removeItem($art, $num) {
		if (isset ( $this->items [$art] ) && $this->items [$art] >= $num) {
			$this->items [$art] -= $num;
			if ($this->items [$art] == 0)
				unset ( $this->items [$art] );
			return true;
		} else
			return false;
	}
	private function getTotalPriceforItem($prodId, $quantity)
	{
		$price = $this->products[$prodId]->price;
		return $price * $quantity;
	}
	
	public function display() {
		$totalPrice = 0;
		echo "<table border=\"1\">";
		echo "<tr><th>Artikel</th><th>Anzahl</th><th>Preis</th></tr>";
		foreach ($this->products as $art ){
			$prodId = $art->id;
			$quantity = $this->productQuantity[$prodId];
			$price = $this->getTotalPriceforItem($prodId, $quantity);
			$totalPrice+= $price;
			echo "<tr><td>".$art->name."</td><td>".$quantity."</td><td>".$price."</td></tr>";
		}
		echo "<tr><td> <b> Total </b></td><td><td><b>".$totalPrice."</b></td></tr>";
		echo "</table>";
	}
}
?>
