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
$result = mysql_query("SELECT * FROM factions ORDER BY member_size DESC") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["factions"] = array();
	$startVal = array();
	$num = 0;
	$total = mysql_num_rows($result);
    while ($row = mysql_fetch_array($result)) {
		
		if ($num == 0)
		{
			$startVal = $row;
			$startVal[fid] = 0;
			$startVal[fname] = "Total Factions: ".$total." factions";
			array_push($response["factions"], $startVal);
			$startVal[fid] = 0;
			$startVal[fname] = " ";
			array_push($response["factions"], $startVal);
		}
		$num++;
		$row[fname] = $num.". ".$row[fname]."\t\tLVL: ".$row[flevel]."\t\tMembers: ".$row[member_size];
        array_push($response["factions"], $row);
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
