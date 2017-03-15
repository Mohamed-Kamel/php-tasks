<?php
	

	// echo "<pre>";	

	
	include_once("./functions.php");

	session_start();

	if(!isset($_SESSION["username"])){
		//login automaticaly

		header("refresh:0;url=Controller.php");
	}else{

		$db = new Database();

		if(isset($_GET["id"])){	
			
			$db->delete($_GET['id']);
			exit;

		}

		if(isset($_POST["column"])){

			$db->save($_POST["column"]);

		}

		$columns = $db->getColumns();

		echo load_view('./views/ajax-example.php', ["columns" => $columns]);
	}
	/**
	* 
	*/
	class Database
	{	
		private $conn;
		private $errors = [];
		
		function __construct()
		{
			$this->conn = mysqli_connect("localhost", "root", "", "grades");

		}

		public function getColumns(){
			$query = "SELECT * FROM symbols";

			$result = $this->conn->query($query);

			$symbols = [];

			if($result->num_rows >0){
				while($row = $result->fetch_assoc()){
					$symbols[$row["id"]] = $row["column_name"];
				}
			}

			return $symbols;
		}


		public function delete($id){

			$query = "DELETE FROM symbols WHERE id=$id";

			$result = $this->conn->query($query);
	
			
			// echo json_encode($prices);			
			//Erorr
			if($this->conn->affected_rows > 0){
				return json_encode(true);
			}else{
				$errors[] = "Can't delete column!";
				// return json_encode(['success' => false]);
				return json_encode(false);
			}
		}


		public function save($column){
			$query = "INSERT INTO symbols SET column_name='$column'";

			$result = $this->conn->query($query);
		
			// echo json_encode($prices);			
			//Erorr
			if($this->conn->affected_rows > 0){
				return json_encode(true);
			}else{
				$errors[] = "Can't delete column!";
				return json_encode(false);
			}	
		}


		public function login($data){

		}

		function __destruct(){
			$this->conn->close();
		}
	}