<?php
class admin{
	public $type;
	//Form erstellen, indem alle Spalten in der Produkt und in der typspezifischen Tabelle ausgelesen werden
	function showForm(){
		$db = new dbconnector();
	
		//Produktspalten
		$query = "SELECT `COLUMN_NAME`
		FROM `INFORMATION_SCHEMA`.`COLUMNS`
		WHERE `TABLE_SCHEMA`='pchammer'
    	AND `TABLE_NAME`='product'";
		$db->setQuery($query);
		$res = $db->queryDB();
	
		while($row = $res->fetch_assoc()){
			echo "<input type='text' name='".$row['COLUMN_NAME']."'/>";
			echo $row['COLUMN_NAME'] . "<br />";
		}
	
		//typspezifischen Spalten
		$query = "SELECT `COLUMN_NAME`
		FROM `INFORMATION_SCHEMA`.`COLUMNS`
		WHERE `TABLE_SCHEMA`='pchammer'
   	 	AND `TABLE_NAME`='".$this->type."'";
		$db->setQuery($query);
		$res = $db->queryDB();
	
		while($row = $res->fetch_assoc()){
			echo "<input type='text' name='".$row['COLUMN_NAME']."'/>";
			echo $row['COLUMN_NAME'] . "<br />";
		}
	
		//submit und hidden mit page wert
		echo "<button type='submit' class='btn btn-default btn-lg'>Insert</button>";
		echo "<input type='textbox' hidden name='page' value='admin'/>";
	}
	
}