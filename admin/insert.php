<?php 

require_once 'connect.php';

require_once 'header.php';

?>
<div class="container">
	<?php 

	if(isset($_POST['addmerchant'])){

		if( empty($_POST['user']) || empty($_POST['pass']) || empty($_POST['mname']) ){
			echo "<div class='alert alert-danger'>Please fillout all required fields</div>";
		}else{		
			$user  = $_POST['user'];
			$pass 	= $_POST['pass'];
			$mname 	= $_POST['mname'];
			
			$pass = hash('sha256',$pass);
			
			
			$sql ="INSERT INTO merchants VALUES (NULL,'$user','$pass','$mname',CURRENT_TIMESTAMP)";
			
			

			if( $con->query($sql) === TRUE){
				echo "<div class='alert alert-success'>Successfully added new user</div>";
			}else{
				echo "<div class='alert alert-danger'>Error: There was an error while adding new user</div>";
			}
		}
	}
	?>
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="box">
			<h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Add New Merchant</h3> 
			<form action="" method="POST">
				<label for="user">Merchant Username</label>
				<input type="text" id="user"  name="user" class="form-control"><br>
				<label for="pass">Merchant Password</label>
				<input type="text"  name="pass" id="pass" class="form-control"><br>
				<label for="mname">Merchant Name</label>
				<input type="text"  name="mname" id="mname" class="form-control"><br>
				<br>
				<input type="submit" name="addmerchant" class="btn btn-success" value="Add New">
			</form>
		</div>
	</div>
</div>
</div>

<?php 

 require_once 'footer.php';