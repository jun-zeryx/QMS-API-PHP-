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

if (isset($_GET["id"])) {
	$id = $_GET['id'];

	$sql = "SELECT * FROM tickets WHERE q_id = '$id'";
	$result = mysqli_query($con, $sql);

	if(mysqli_num_rows($result) != 0) {

		$tickets = array();

		while($row = $result->fetch_object())
		{
			$tickets[] = $row;
		}

		$response["code"] = 0;
		$response["msg"] = "tickets retrieved successfully";
		$response["tickets"] = $tickets;

		echo json_encode($response);
	}
	else {
		$response["code"] = 2;
		$response["msg"] = "user does not have any tickets";

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
