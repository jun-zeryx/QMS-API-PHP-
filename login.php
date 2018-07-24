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

if (isset($_GET["user"]) && isset($_GET["pass"])) {
	$user = $_GET['user'];
	$pass = $_GET['pass'];
	
	$pass = hash('sha256',$pass);
	
	$sql = "SELECT * FROM users WHERE username = '$user' and password = '$pass'";
	
	$result = mysqli_query($con, $sql);
 
	if(mysqli_num_rows($result) != 0) {
		
		$users = array();
 
		while($row = $result->fetch_object())
		{
			$users = $row;
		}
		
		$response["code"] = 0;
		$response["msg"] = "Login success";
		$response["userInfo"] = array();
		
		array_push($response["userInfo"], $users);
 
		echo json_encode($response);
	}
	else {
		$response["code"] = 2;
		$response["msg"] = "Login failed";
		
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