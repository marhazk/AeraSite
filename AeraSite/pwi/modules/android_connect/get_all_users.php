<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table
$result = mysql_query("SELECT * FROM users ORDER BY name ASC") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["users"] = array();
	$startVal = array();
	$num = 0;
	$total = mysql_num_rows($result);
    while ($row = mysql_fetch_array($result)) {
		
		if ($num == 0)
		{
			$startVal = $row;
			$startVal[ID] = 0;
			$startVal[name] = "Total of Accounts: ".$total." users";
			array_push($response["users"], $startVal);
			$startVal[ID] = 0;
			$startVal[name] = " ";
			array_push($response["users"], $startVal);
		}
		$num++;
		$row[name] = $num.". ".$row[name];
        array_push($response["users"], $row);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No online found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
