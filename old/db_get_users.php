<?php
 
/*
 * Following code will get single users details
 * A users is identified by users id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["uid"])) {
    $uid = $_GET['uid'];
 
    // get a users from userss table
    $result = mysql_query("SELECT *FROM users WHERE u_id = $uid");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $users = array();
            $users["u_id"] = $result["u_id"];
            $users["u_fname"] = $result["u_fname"];
            $users["u_lname"] = $result["u_lname"];
            $users["u_nric"] = $result["u_nric"];
            $users["created_at"] = $result["created_at"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["users"] = array();
 
            array_push($response["users"], $users);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no users found
            $response["success"] = 0;
            $response["message"] = "No users found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no users found
        $response["success"] = 0;
        $response["message"] = "No users found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>