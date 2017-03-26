<?php

include_once("../model/StudentModel.php");
include_once("../includes/functions.php");
include_once("../includes/HTMLElement.php");
include_once("../includes/Form.php");

$studentController = new StudentController();

// print_r($_POST);	

if(isset($_GET['search'])){
	
	$studentController->getStudent($_GET["id"]);

}elseif(isset($_POST['save'])){

	$studentController->addStudent($_POST);
	$studentController->showAll();

}elseif(isset($_POST['edit'])){
	//show edit form edit form with the student_id

	//validate id
	
	$studentController->editStudentData($_POST['student_id']);

	

}elseif(isset($_POST['update'])){

	$studentController->editStudent($_POST);
	$studentController->showAll();

}elseif(isset($_POST['delete'])){

	$studentController->deleteStudent($_POST['student_id']);
	$studentController->showAll();

}else{

	$studentController->showAll();

}


/**
* 
*/
class StudentController{
	
	private $studentModel;
	public $students = [], $student = [];
	public $page = 0;
	public $pre = null;
	public $next = null;
	public $msg = [];


	public function __construct()
	{
		$this->studentModel = new StudentModel();
		
	}


	/**
	 *
	 * Show all students and paginate them
	 *
	 */
	
	public function showAll(){
		$offset = 0;
		$limit = 15;
		$pre = 0;
		$next = 1;

		$rows = $this->studentModel->getNumOfRows();

		$total=ceil($rows / $limit);

		if(isset($_GET['page'])){
			$page = $_GET['page'];
			$offset = ($page-1)*$limit;

			if($page > 1){
				$pre = $page - 1;
				$next = $page + 1;
			}

			if($page < $total){
				$pre = $page - 1;
				$next = $page + 1;
			}


			if($page == 1){
				$pre = 1;
				$next = $page + 1;
			}

			if($page == $total){
				$pre = $page - 1;
				$next = $total;
			}
		}else{
			$pre = 1;
			$next = 2;
		}

		if($this->studentModel->getAll($offset, $limit)){
			$students = $this->studentModel->getAll($offset, $limit);
		}	

		echo load_view("../view/form.php",  ["students"=>$students, "pre" => $pre, "next" => $next]);
	}


	/**
	 *
	 * get students by id
	 *
	 */
	
	public function getStudent($id){
		//validate id


		if($this->studentModel->getById($id)){
			$student = $this->studentModel->getById($id);
		}	

		echo load_view("../view/form.php", ["student"=>$student]);

	}

	/**
	 *
	 * Get student data
	 *
	 */
	
	public function editStudentData($id){
		//validate id

		$editStudent = [];

		if($this->studentModel->getById($id)){
			$editStudent =  $this->studentModel->getById($id);
		}

		// return json_encode($editStudent);

		echo load_view("../view/form.php", ['editStudent' => $editStudent]);
	}


	/**
	 *
	 * Add new Student
	 *
	 */
	
	public function addStudent($data){
		//validate data

		$data["first_name"] = $_POST["first_name"];
		$data["last_name"] = $_POST["last_name"];
		$data["email"] = $_POST["email"];
		$data["dob"] = $_POST["dob"];

		if($this->studentModel->insertStudent($data)){
			$msg["insert"] = "Succeeded to insert a new student";
		}else{
			$msg["insert"] = "Failed to insert a new student";
		}

		//echo load view with msg
	}



 	/**
 	 *
 	 * Delete student by id
 	 *
 	 */
 	
	public function deleteStudent($id){
		//validate id

		if($this->studentModel->deleteById($id)){

			$msg["delete"] = "Succeeded to delete student";

		}else{

			$msg["delete"] = "Failed to delete student";

		}
		//echo load view with msg
		// return $msg;
	}



	/**
	 *
	 * Edit student info by id
	 *
	 */
	
	public function editStudent($data){
		//validate data 
		
		// $data["student_id"] = $data[];

		if($this->studentModel->updateById($data)){

			// $msg["edit"] = "Succeeded to edit student";
			return json_encode("Succeeded to edit student");

		}else{
			
			// $msg["edit"] = "Failed to edit student";
			return json_encode("Failed to edit student");
			
		}
		//echo load view with msg
		
		// return json_encode($msg);
	}

}