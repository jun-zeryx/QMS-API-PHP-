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

if (isset($_GET["user"]) && isset($_GET["pass"]) && isset($_GET["mname"])) {
	$user = $_GET['user'];
	$pass = $_GET['pass'];
	$mname = $_GET['mname'];

	$pass = hash('sha256',$pass);

	$sql = "INSERT INTO merchants VALUES (NULL,'$user','$pass','$mname',CURRENT_TIMESTAMP)";

	$result = mysqli_query($con, $sql);


	if($result) {
		$response["code"] = 0;
		$response["msg"] = "Register success";

		echo json_encode($response);
	}
	else {
		$response["code"] = mysqli_errno($con);
		$response["msg"] = mysqli_error($con);

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
