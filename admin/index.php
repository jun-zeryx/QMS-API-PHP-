<?php 

require_once 'connect.php';

require_once 'header.php';

echo "<div class='container'>";

if( isset($_POST['delete'])){
	$sql = "DELETE FROM merchants WHERE m_id =" . $_POST['m_id'];
	if($con->query($sql) === TRUE){
		echo "<div class='alert alert-success'>Successfully deleted merchant</div>";
	}
}

$sql 	= "SELECT * FROM merchants";
$result = $con->query($sql); 

if( $result->num_rows > 0)
{ 
	?>
	<h2>List of all merchants</h2>
	<table class="table table-bordered table-striped">
		<tr>
			<td>MID</td>
			<td>Merchant Username</td>
			<td>Merchant Password</td>
			<td>Merchant Name</td>
			<td width="70px">Delete</td>
		</tr>
	<?php
	while( $row = $result->fetch_assoc()){ 
		echo "<form action='' method='POST'>";
		echo "<input type='hidden' value='". $row['m_id']."' name='m_id' />";
		echo "<tr>";
		echo "<td>".$row['m_id'] . "</td>";
		echo "<td>".$row['m_username'] . "</td>";
		echo "<td>".$row['m_password'] . "</td>";
		echo "<td>".$row['m_name'] . "</td>";
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