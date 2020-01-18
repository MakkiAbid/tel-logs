<?php
	
	if(isset($_POST['btn'])){

		$name = null;
		$phone = null;	


		if(notEmpty($_POST['name'])){
			if(preg_match('/^[a-zA-Z ]+$/', $_POST['name'])){
				$name = clearInput($_POST['name']);
			}else{
				$name_error = '<p class="red text">Only alphabets are allowed.</p>';
			}
		}else{
			$name_error = '<p class="red text">Field is not to be empty</p>';
		}


		if(notEmpty($_POST['phone'])){
			if(is_numeric($_POST['phone'])){
				$phone = clearInput($_POST['phone']);
			}else{
				$phone_error = '<p class="red text">Only numerics are allowed.</p>';
			}
		}else{
			$phone_error = '<p class="red text">Field is not to be empty</p>';
		}



		if(notEmpty($name) && notEmpty($phone)){
			$query = "INSERT INTO `logs` (name,phone_no) VALUES ('$name', '$phone')";
			if(mysqli_query($conn, $query)){
				$message = '<div class="ui success message">
					<div class="header">
						Success
					</div>
					<p>Record is inserted successfully.</p>
				</div>';
			}else{
				$message = '<div class="ui error message">
					<div class="header">
						Error
					</div>
					<p>Something went wrong please try again.</p>
				</div>';
			}
		}



	}// main if ends


?>


<div class="ui container mt-lg-5">
	<div class="ui grid">
		<div class="six wide column">
			<div class="ui stacked segment">
				<a class="ui black right ribbon label">Add Record</a>
					<?php if(isset($message)) echo $message; ?>
					<form class="ui form" action="" method="post">
					  <div class="field <?php if(isset($name_error)) echo "error"; ?>">
					    <label>Name</label>
					    <input type="text" name="name" placeholder="Name">
					    <?php if(isset($name_error)) echo $name_error; ?>
					  </div>
					  <div class="field <?php if(isset($phone_error)) echo "error"; ?>">
					    <label>Phone</label>
					    <input type="text" name="phone" placeholder="Phone">
					    <?php if(isset($phone_error)) echo $phone_error; ?>
					  </div>
						<button type="submit" class="ui secondary button" name="btn">
	    					Submit 
	  					</button>
					</form>
			</div>
		</div>
		<div class="ten wide column">
			<div class="ui stacked segment">
				<a class="ui black right ribbon label">Records</a>
				<table class="ui celled table" id="table">
				  <thead>
				    <tr>
				    	<th>Name</th>
				    	<th>Phone</th>
				    	<th>Created At</th>
				  	</tr>
				  </thead>
				  <tbody>
				  	<?php
				  		$recordSql = "SELECT * FROM `logs` ORDER BY `id` DESC";
				  		$records = mysqli_query($conn, $recordSql);
				  		while($record = mysqli_fetch_assoc($records)):
				  	?>
				    <tr>
				      <td><?= $record['name'] ?></td>
				      <td><?= $record['phone_no'] ?></td>
				      <td><?= date('M d, Y', strtotime($record['created_at'])) ?></td>
				    </tr>
				<?php endwhile; ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#table").DataTable({
			"ordering": false
		});
	});
</script>