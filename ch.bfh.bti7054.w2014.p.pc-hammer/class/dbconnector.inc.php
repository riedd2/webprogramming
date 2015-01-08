<?php
if(!isset($_SESSION)) session_start();
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
	
	public function setQuery($query){
		$this->sql = $query;
	}
	
	public function queryDB(){
		if(!$this->result = $this->db->query($this->sql)){
			die('There was an error running the query [' . $this->db->error . ']');
		}
		$this->lastid = $this->db->insert_id;
		return $this->result;
	}
	
	private function makeQuery($orderid, $order){
		//get user id
		$userid = $_SESSION['userid'];
		$querypart = "(".$orderid.", %d, %d)";
		$query = "INSERT INTO `pchammer`.`orderposition` (`order_id`, `product_id`, `quantity`) VALUES ";
		
		$numItems = count($order);
		
		foreach ($order as $key => $value){
		$query .= sprintf($querypart, $key, $value).",";	
		}
		//remove last comma
		$query = rtrim($query,',');

		//necessary?
		$query .= ";";
		return $query;
	}
	
	public function saveOrder($order){
		$userid = $_SESSION['userid'];
		$query = sprintf("INSERT INTO `pchammer`.`order` (`user_id`) VALUES (%d)", $userid);
		$this->setQuery($query);
		$this->queryDB(); 
		$query = $this->makeQuery($this->lastid, $order);
		$this->setQuery($query);
		$this->queryDB();

		//return how many rows are affected to determine if save was successfull
		return $this->db->affected_rows;
	}
	
	public function checkUserPassword($username, $password){
		$query = sprintf("SELECT id_user, username, admin FROM user WHERE username = '%s' AND password = '%s'", $username, $password);
		$this->setQuery($query);
		$this->queryDB();

		if(mysqli_num_rows($this->result) == 1){
			$row = $this->result->fetch_assoc();
			$_SESSION ["userid"] = $row['id_user'];
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