<?php
 
require_once __DIR__ . '/config.php';
 
// Create connection
$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$response = array();

if (isset($_GET["user"])) {
	$user = $_GET['user'];
	
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$result = mysqli_query($con, $sql);
 
	if(mysqli_num_rows($result) != 0) {
		
		$users = array();
 
		while($row = $result->fetch_object())
		{
			$users = $row;
		}
		
		$response["code"] = 0;
		$reponse["msg"] = "Username found";
		$response["user"] = array();
		
		array_push($response["user"], $users);
 
		echo json_encode($response);
	}
	else {
		$response["code"] = 2;
		$response["msg"] = "User does not exist";
		
		echo json_encode($response);
	}
}

else {
	$response["code"] = 1;
    $response["msg"] = "Required params missing";
 
    echo json_encode($response);
}
 

 
// Close connections
mysqli_close($con);
?>