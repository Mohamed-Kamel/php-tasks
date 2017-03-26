<?php

include_once("./functions.php");


session_start();

$db = new Controller();

if(isset($_POST["logout"])){

	unset($_SESSION['username']);
	session_destroy();
	$db->showLogin();	
}elseif(isset($_SESSION["username"])){
	//login automaticaly

	header("refresh:0;url=ajax.php");

}elseif(isset($_POST["login"])){
	$captcha = $_POST["g-recaptcha-response"];
	$secret = "6LcEHRkUAAAAAH9BxnHbClAFzvXpNXyznYWbs0JK" ;
	if($_POST["g-recaptcha-response"]){
		$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

        if($response['success'] == false){
       	  	
       	  	$db->errors[] = "Error you are a bot";
            $db->showLogin();

        }else{

            $db->login($_POST);

        }
	}

}else{
	//show login form

	$db->showLogin();

}

/**
* 
*/
class Controller
{
	private $conn;
	public $errors = [];

	function __construct()
	{
		$this->conn = mysqli_connect("localhost", "root", "", "grades");
	}


	public function login($inputs){
		//validate inputs
		// print_r($inputs);
		$name_pattern = "/[a-z_@#$&*]+/i";


		$password_pattern = "/[a-z '_]/i";

		$username = $this->validate($name_pattern, $inputs["username"]);
		$password = $this->validate($password_pattern, $inputs["password"]);
		
		if(!$username){
			$this->errors[] = "User name is not valid";
		}
		
		if(!$password){
			$this->errors[] = "Password is not valid";
		}


		if(count($this->errors) < 1){
			$userData = $this->getUser($username);
			
			if($userData["user_name"] == $username && $userData["password"] == $password){
				$_SESSION['username'] = $username;
				header("refresh:0;url=ajax.php");
				exit;
			}else{		
			
				$this->errors[] = "The username or password is not true";
				header('HTTP/1.0 403 Forbidden');
				$this->showLogin();				
			}

		}else{
			
			header('HTTP/1.0 403 Forbidden');
			$this->showLogin();

		}

		//add captcha



	}


	private function validate($pattern, $input){
		
		$input = strip_tags($input);

		if(!preg_match($pattern, $input)){    
        	return false;
	    }

	    return $input;
	}

	public function getUser($username){
		$query = "SELECT * FROM users WHERE user_name=? LIMIT 1";

		// $result = $this->conn->prepare($query);

		$result = $this->conn->prepare($query);
	
		$result->bind_param("s", $name);
		
		$name = $username;
		
		$user = [];

		if($result->execute()){
			
			$result->bind_result($user_id, $user_name, $password);
			$result->fetch();
			$user["user_id"] = $user_id;
			$user["user_name"] = $user_name;
			$user["password"] = $password;
	
		}
		
		return $user;
	}

	public function showLogin(){
		
		echo load_view("./views/login-form.php", ["errors" => $this->errors]);

	}


	function __destruct(){
		$this->conn->close();
	}

}