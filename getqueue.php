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

if (isset($_GET["qid"])) {
	$qid = $_GET['qid'];

	$sql = "SELECT * FROM queues WHERE q_id = '$qid'";
	$result = mysqli_query($con, $sql);

	if(mysqli_num_rows($result) != 0) {

		$queue = array();

		while($row = $result->fetch_object())
		{
			$queue = $row;
		}

		$response["code"] = 0;
		$response["msg"] = "Queue found";
		$response["queue"] = $queue;

		echo json_encode($response);
	}
	else {
		$response["code"] = 2;
		$response["msg"] = "Queue does not exist";

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
