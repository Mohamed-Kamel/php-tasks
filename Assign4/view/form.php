<!DOCTYPE html>
<html>
<head>
	<title>Assignment 4</title>
	<link rel="stylesheet" href="../assets/bootstrap.min.css">
<style>

	#addForm{
		display: none;
	}

</style>
</head>
<body>

<div class="navbar navbar-default">
	<div class="form-inline col-xs-10">
		<form class="col-xs-offset-1" method="get" id="search">
			<div class="col-xs-4">
				<input type="number" name="id" placeholder="Search by ID" class="form-control">
				<button type="submit" name="search" class="btn btn-default">Search</button>
			</div>
		</form>
	
		<div class="form-group col-xs-offset-4">
			<a href="" id="showStudents" class="btn btn-default">Show Students</a>
			<a href="" id="addStudent" class="btn btn-default">Add Student</a>
		</div>
	</div>
</div>

<div class="container">
<table id="data" class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>DOB</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($data['student']) && count($data['student'])){ 
			$student = $data['student'];
			?>
			<form action="" method="post">
				<tr>
					<td><?php echo $student['student_id']; ?></td>
					<td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
					<td><?php echo $student['email']; ?></td>
					<td><?php echo $student['DOB']; ?></td>
					<input id="key" type="hidden" name="student_id" value="<?php echo $student["student_id"]; ?>">
					<td><input class="btn btn-default" type="submit" id="edit" name="edit" value="Edit"></td>
					<td><input class="btn btn-default" type="submit" id="delete" name="delete" value="Delete"></td>
				</tr>	
			</form>
			<?php }elseif(isset($data['students'])){?>
		<?php foreach($data['students'] as $i => $student){?>
			<form action="" method="post">
				<tr>
					<td><?php echo $student['student_id']; ?></td>
					<td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
					<td><?php echo $student['email']; ?></td>
					<td><?php echo $student['DOB']; ?></td>
					<input id="key" type="hidden" name="student_id" value="<?php echo $student["student_id"]; ?>">
					<td><input class="btn btn-default" type="submit" id="edit" name="edit" value="Edit"></td>
					<td><input class="btn btn-default" type="submit" id="delete" name="delete" value="Delete"></td>
				</tr>
			</form>
		<?php } }?>
	</tbody>
</table>

<?php
	
	$form = new Form('post', '', 'addFrom');
	$form->addText('first_name', 'First name');
	$form->addText('last_name', 'Last name');
	$form->addText('email', 'Email');
	$form->addText('dob', 'Date of birth (yyyy-mm-dd)');
	// $form->addTextArea("hadsf", 5, 5, "hamada");
	// $form->addSelect("hamada", ["car" => "Car", "bike" => "Bike"]);
	$form->addSubmit('save', 'Add student', "add");
	echo $form->write();

	if(isset($data["pre"] , $data["next"])){
		$pre =  $data["pre"];
		$next = $data["next"];
?>
<div id="footer" class="form-group">
	<a class="btn btn-default" href="?page=<?php echo $pre; ?>">Previous</a>
	<a class="btn btn-default" href="?page=<?php echo $next; ?>">Next</a>
</div>
<?php
	}

	if(isset($data["editStudent"])){
		//call attributes
		$editStudent = $data["editStudent"];
		$form = new Form('post', '', 'edit', 'editForm');
		$form->addText('first_name', 'First name', $editStudent['first_name'], 'first');
		$form->addText('last_name', 'Last name', $editStudent['last_name'], 'last');
		$form->addText('email', 'Email', $editStudent['email'], 'email');
		$form->addText('dob', 'Date of birth (yyyy-mm-dd)', $editStudent['DOB'], 'dob');
		$form->addText("student_id", '' ,$editStudent["student_id"], 'id', "hidden");
		$form->addSubmit('update', 'Edit student', 'update');
		echo $form->write();
	}
?>

</div>
<script type="text/javascript" src="../assets/jquery.min.js"></script>
<script type="text/javascript" src="../assets/bootstrap.min.js"></script>
<script>

	var add = $("#addFrom");
	var dataTable = $("#data");
	add.hide();
	$("#addStudent").on("click", function(event){
		event.preventDefault();
		dataTable.remove();
		add.slideDown(500);
		$("#footer").hide();
	});


	$("#showStudents").on("click", function(event){
		add.slideUp(500);
		$("#footer").show();
	});

	// var addForm   = $("#add");
	// var editForm  = $("#edit");
	// var dataTable = $("#data");
	// var editBtn   = $("#edit");
	// var deleteBtn = $("#delete");
	// var add       = $("#add");
	// var update    = $("#update");

	// editForm.on("click", function(event){
	// 	event.preventDefault();
	// 	var student_id = $("#key").val();

	// 	$.ajax({
	// 		method : "post",
	// 		data : {"student_id": student_id, "edit"	 : "edit"},

	// 		success : function(response){
				
	// 			console.log("success" , JSON.parse(response));
	// 		},

	// 		error : function(error){
	// 			console.log("error", JSON.parse(error));
	// 		}
	// 	});



	// 	dataTable.slideUp(1000);
	// 	editForm.slideDown(1000);
	// });

	// update.on("click", function(event){
		
	// 	event.preventDefault();

	// 	var student_id = $("#id").val();
	// 	var first_name = $("#first").val();
	// 	var last_name = $("#last").val();
	// 	var email = $("#email").val();
	// 	var dob = $("#dob").val();

	// 	$.ajax({
	// 		method : "post",
	// 		data : {"student_id": student_id, 
	// 		"first_name" : first_name, 
	// 		"last_name"  : last_name,
	// 		"email"		 : email,
	// 		"dob"		 : dob,
	// 		"update"	 : "update"
	// 		},

	// 		success : function(response){
				
	// 			console.log("success" , JSON.parse(response));
	// 		},

	// 		error : function(error){
	// 			console.log("error", JSON.parse(error));
	// 		}
	// 	});

	// 	editForm.slideUP();
	// 	dataTable.slideDown();

	// });

</script>

</body>
</html>
