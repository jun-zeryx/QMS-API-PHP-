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

	$sql = "SELECT * FROM queues WHERE m_id = '$id'";
	$result = mysqli_query($con, $sql);

	if(mysqli_num_rows($result) != 0) {

		$queues = array();

		while($row = $result->fetch_object())
		{
			$queues[] = $row;
		}

		$response["code"] = 0;
		$response["msg"] = "queues retrieved successfully";
		$response["queues"] = array();

		array_push($response["queues"], $queues);

		echo json_encode($response);
	}
	else {
		$response["code"] = 2;
		$response["msg"] = "merchant does not have any queues";

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
