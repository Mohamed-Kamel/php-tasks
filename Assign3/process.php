<?php

	include('./functions.php');



	// step 1 & 2: connect to server and select db
	$link = @mysqli_connect('localhost', 'root', '', 'grades');
	if(!$link){
		echo mysqli_connect_error();
		die;
	}

	$students = [];
	$student = [];
	$page = 0;
	$pre = null;
	$next = null;

	if(isset($_GET['search']) && !empty($_GET['email'])){
		$email = trim($_GET['email']);
		$res = mysqli_query($link, "select * from students where email='$email' limit 1");
		if(!$res){
			echo mysqli_error($link);
			die;
		}
		$student = mysqli_fetch_assoc($res);	
	}else{

		$offset = 0;
		$limit = 15;
		$pre = 0;
		$next = 1;

		$rows = mysqli_query($link, "SELECT COUNT(*) AS count FROM students");
		$rows = mysqli_fetch_assoc($rows);	
		$rows = $rows["count"];
		$total=ceil($rows / $limit);

//			$page = $_GET['page'];

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

		// step 3: query db
		$res = mysqli_query($link, "select * from students limit $offset, $limit");
		
		if(!$res){
			echo mysqli_error($link);
			die("");
		}
	
		// step 3.5: handle result set
		
		while($record = mysqli_fetch_assoc($res)){
			$students[] = $record;
		}
	
	}	
	//echo '<pre>';
	//print_r($students);
	//echo '</pre>';
	
	echo load_view('./views/form.php', ['students' => $students, 'student'=>$student,
	 "pre"=>$pre, "next"=>$next]);


	// step 4: close connection -- optional step
	mysqli_close($link);
