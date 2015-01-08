<?php
class dbconnector{
	public $db;
	public $sql;
	public $result;
	public $lastid;
	
	function __construct(){
		$this->db = new mysqli('localhost', 'pchammer', 'Hallo123', 'pchammer');
		if($this->db->connect_errno > 0){
			die('Unable to connect to database [' . $this->db->connect_error . ']');
		}
	}	
	
	function setQuery($query){
		$this->sql = $query;
	}
	
	function queryDB(){
		if(!$this->result = $this->db->query($this->sql)){
			die('There was an error running the query [' . $this->db->error . ']');
		}
		$this->lastid = $this->db->insert_id;
		return $this->result;
	}
	
	function showResult(){
		echo "<h1>res</h1>";
		while($row = $this->result->fetch_assoc()){
			
			echo $row['name'] . '<br />';
		}
	}
	
	private function makeQuery($orderid, $order){
		//get user id
		$userid = 1;//$_SESSION['']
		$querypart = "(".$orderid.", %d, %d)";
		$query = "INSERT INTO `pchammer`.`orderposition` (`order_id`, `product_id`, `quantity`) VALUES ";
		
		$numItems = count($order);
		$i = 0;
		
		foreach ($order as $key => $value){
			if(++$i === $numItems) {
				$query .= sprintf($querypart, $userid, $key, $value);	
			}else{
				$query .= sprintf($querypart, $userid, $key, $value).",";
			}
		}
		
		//necessary?
		$query .= ";";
		return $query;
	}
	function saveOrder($order){
		$userid = 1;
		$query = sprintf("INSERT INTO `pchammer`.`order` (`user_id`) VALUES (%d)", $userid);
		$this->setQuery($query);
		$this->queryDB(); 
		echo $this->db->affected_rows;
		$query = $this->makeQuery($this->lastid, $order);
		$this->setQuery($query);
		$this->queryDB();
		echo $this->db->affected_rows;
		
		return $this->db->affected_rows;
		//get how many rows affected
	
	}
	
	function checkUserPassword($username, $password){
		$query = sprintf("SELECT username, admin FROM user WHERE username = '%s' AND password = '%s'", $username, $password);
		$this->setQuery($query);
		$this->queryDB();

		if(mysqli_num_rows($this->result) == 1){
			$row = $this->result->fetch_assoc();
			if($row['admin'] == 1)
				$_SESSION ["admin"] = true;
				
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
	
	
	