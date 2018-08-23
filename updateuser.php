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

if (isset($_GET["uid"]) &&isset($_GET["lname"]) && isset($_GET["fname"]) && isset($_GET["nric"])) {
	$uid = $_GET['uid'];
	$lname = $_GET['lname'];
	$fname = $_GET['fname'];
	$nric = $_GET['nric'];
	
	$sql = "UPDATE users SET u_lname = '$lname',u_fname = '$fname',u_nric = '$nric' WHERE u_id = '$uid'";

	$result = mysqli_query($con, $sql);


	if($result) {
		$response["code"] = 0;
		$response["msg"] = "Update success";

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
