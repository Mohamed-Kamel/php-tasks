<style>
	th { border-bottom: solid 2px navy; }
	td { 
		border-bottom: dotted 1px silver; 
		border-right: dotted 1px silver; 
		padding: 5px;
	}
</style>
<form action="" method="get">
	<input type="text" name="email">
	<input type="submit" name="search" value="submit">
</form>

<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>DOB</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($data['student'])){ 
			$student = $data['student'];
			?>
			<tr>
				<td><?php echo $student['student_id']; ?></td>
				<td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
				<td><?php echo $student['email']; ?></td>
				<td><?php echo $student['DOB']; ?></td>
			</tr>	
			<?php }else{?>
		<?php foreach($data['students'] as $i => $student){?>
			<tr>
				<td><?php echo $student['student_id']; ?></td>
				<td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
				<td><?php echo $student['email']; ?></td>
				<td><?php echo $student['DOB']; ?></td>
			</tr>
		<?php } }?>
	</tbody>
</table>
<?php

if(isset($data["pre"] , $data["next"])){
	$pre =  $data["pre"];
	$next = $data["next"];
?>
<a href="?page=<?php echo $pre; ?>">Previous</a>
<a href="?page=<?php echo $next; ?>">Next</a>
<?php
}
?>