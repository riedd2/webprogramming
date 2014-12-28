<?php
class dbconnector{
	public $db;
	public $sql;
	public $result;
	
	function __construct(){
		$this->db = new mysqli('localhost', 'pchammer', 'Hallo123', 'pchammer');
		if($this->db->connect_errno > 0){
			die('Unable to connect to database [' . $this->db->connect_error . ']');
		}
	}	
	
	function setQuery($query){
// 		$join = "SELECT *
// 			FROM graphicscard as g left join product as p
// 			on g.id_graphicscard = p.id_product
// 			order by id_product";
		
		$this->sql = $query;
	}
	
	function queryDB(){
		if(!$this->result = $this->db->query($this->sql)){
			die('There was an error running the query [' . $this->db->error . ']');
		}
		
		return $this->result;
	}
	
	function showResult(){
		echo "<h1>res</h1>";
		while($row = $this->result->fetch_assoc()){
			
			echo $row['name'] . '<br />';
		}
	}
	
	function checkUserPassword($username, $password){
		$this->setQuery("SELECT username FROM user WHERE username = '".$username."' AND password = '".$password."'");
		$this->queryDB();

		if(mysqli_num_rows($this->result) == 1){
			return true;
		}else{
			if(mysqli_num_rows($this->result) == 0)
				echo "no user with provided credentials found";
			return false;
		}
	}
	
	function __destruct(){
		$this->db->close();
	}
}
	
	
	