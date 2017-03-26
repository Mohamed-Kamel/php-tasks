<?php
	
require_once("../includes/config.php");

// echo "<pre>";




class StudentModel{
	
	private $conn;
	

	/**
	 *
	 * Constructor to open a DB connection
	 *	
	 */
	
	public function __construct()
	{
		$this->conn = mysqli_connect(HOST, USER, PASS, DB_NAME);
			
	}
	
	/**
	 *
	 * Get num of rows
	 *	@return int
	 *
	 */
	
	public function getNumOfRows(){
		$query = "SELECT COUNT(*) AS count FROM students";

		if($this->conn){
			$result = $this->conn->query($query);
			$rows = $result->fetch_assoc();
			return $rows["count"];
		}else{
			die("Sorry, You can't access Database ".$this->conn->connect_error);
		}
	}

	/**
	 *
	 * Get all students
	 *	@return array
	 */
	
	public function getAll($offset, $limit){

		$query = "SELECT * FROM students LIMIT $offset, $limit";
		// $query = "SELECT * FROM students LIMIT 1, 15";
		

		if($this->conn){

			if($rows = $this->conn->query($query)){
				if($rows->num_rows > 0){
					while($row = $rows->fetch_assoc()){
						$students[] = $row;
					}
				}
				
			}

			return $students;
			
		}else{
			die("Sorry, You can't access Database ".$this->conn->connect_error);
		}

	}


	/**
	 *
	 * Get student by id
	 *	@return array
	 */
	
	public function getById($id){

		$query = "SELECT * FROM students WHERE student_id = ? LIMIT 1";

		if($this->conn){

			// if($rows = $this->conn->query($query)){
			// 	$student = $rows->fetch_assoc();
			// }

			$result = $this->conn->prepare($query);
			$result->bind_param("i", $num);
			$num = $id;
			if($result->execute()){
				$num = null;
				$result->bind_result($id, $first_name, $last_name, $email, $DOB);
				$result->fetch();
				$student = [
				"student_id" => $id,
				"first_name" => $first_name,
				"last_name" => $last_name,
				"email" => $email,
				"DOB" => $DOB];
				return $student;
			}
			
		}else{
			die("Sorry, You can't access Database ".$this->conn->connect_error);
		}
	}


	/**
	 *
	 * Insert new student
	 *	@return boolean
	 */

	public function insertStudent($data){
		$first_name = $data["first_name"];
		$last_name = $data["last_name"];
		$email  = $data["email"];
		$dob = $data["dob"];

		$query = "INSERT INTO students SET first_name = ?,
										last_name = ?,
										email = ?,
										DOB= ?";

		$result = $this->conn->prepare($query);

		$result->bind_param("ssss", $first, $last, $mail, $DOB);

		$first = $first_name;
		$last = $last_name;
		$mail = $email;
		$DOB = $dob;

		if($result->execute()){
			$first = null;
			$last = null;
			$mail = null;
			$DOB = null;

			return true;
		}else{
			return false;
		}

	}

	/**
	 *
	 * Delete Student by ID
	 *
	 */
	
	public function deleteById($id){

		$query = "DELETE FROM students WHERE student_id=?";

		$result = $this->conn->prepare($query);

		$result->bind_param("i", $ID);

		$ID = $id;

		if($result->execute()){
			return true;
		}else{
			return false;
		}

	}


	/**
	 *
	 * Update Student by id
	 *
	 */
	
	public function updateById($data){
		
		$id = (int) $data["student_id"];
		$first_name = $data["first_name"];
		$last_name = $data["last_name"];
		$email = $data["email"];
		$dob = $data["dob"];
		
		

		$query = "UPDATE students SET first_name= ?,
									  last_name = ?,
									  email = ?,
									  dob = ?
									  WHERE student_id = ?";



		
		$result = $this->conn->prepare($query);
	

		$result->bind_param("ssssi", $first, $last, $mail, $DOB, $ID);

		
		$first = $first_name;
		$last = $last_name;
		$mail = $email;
		$DOB = $dob;
		$ID = $id;
		

		$result->execute();

		if($result->affected_rows){
			return true;
		}else{
			return false;
		}
		

	}

	/**
	 *
	 * Close the Database connection
	 *
	 */
	
	function __destruct(){
		$this->conn->close();
	}

}