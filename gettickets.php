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
$sql = "";

if (isset($_GET["qid"]) || isset($_GET["uid"])) {
  if (isset($_GET["qid"])) {
    $qid = $_GET['qid'];
  	$sql = "SELECT * FROM tickets WHERE q_id = '$qid'";
  }
  else {
    $uid = $_GET['uid'];
  	$sql = "SELECT * FROM tickets WHERE u_id = '$uid'";
  }

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
		$response["msg"] = "user or queue does not have any tickets";

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
