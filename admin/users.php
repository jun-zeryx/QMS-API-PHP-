<?php 

require_once 'connect.php';

require_once 'header.php';

echo "<div class='container'>";

if( isset($_POST['delete'])){
	$sql = "DELETE FROM users WHERE u_id =" . $_POST['u_id'];
	if($con->query($sql) === TRUE){
		echo "<div class='alert alert-success'>Successfully deleted user</div>";
	}
}

$sql 	= "SELECT * FROM users";
$result = $con->query($sql); 

if( $result->num_rows > 0)
{ 
	?>
	<h2>List of all users</h2>
	<table class="table table-bordered table-striped">
		<tr>
			<td>UID</td>
			<td>Username</td>
			<td>Password</td>
			<td>Last Name</td>
			<td>First Name</td>
			<td>NRIC</td>
			<td width="70px">Delete</td>
		</tr>
	<?php
	while( $row = $result->fetch_assoc()){ 
		echo "<form action='' method='POST'>";
		echo "<input type='hidden' value='". $row['u_id']."' name='u_id' />";
		echo "<tr>";
		echo "<td>".$row['u_id'] . "</td>";
		echo "<td>".$row['username'] . "</td>";
		echo "<td>".$row['password'] . "</td>";
		echo "<td>".$row['u_lname'] . "</td>";
		echo "<td>".$row['u_fname'] . "</td>";
		echo "<td>".$row['u_nric'] . "</td>";
		echo "<td><input type='submit' name='delete' value='Delete' class='btn btn-danger' /></td>";  
		echo "</tr>";
		echo "</form>";
	}
	?>
	</table>
<?php 
}
else
{
	echo "<div class='alert alert-danger'>No records found</div>";
}
?> 
</div>

<?php 

 require_once 'footer.php';