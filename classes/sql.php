<?php 

class Sql extends PDO{

	private $conn;
	
	public function __construct(){

		$this->conn = new PDO("mysql:dbname=db_php7;host=localhost","root","3212");

	}

	public function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			$stament->setParam($key, $value);
		}

	}

	private function setParam($stament, $key, $value){

		$stament->bindParam($key,$value);
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt,$params);
		$stmt->execute();
		
		return $stmt;

	}
	
	public function select($rawQuery, $params = array()){

		$stmt = $this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

 ?>