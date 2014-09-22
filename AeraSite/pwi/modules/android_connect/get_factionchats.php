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
 include "../functions.php";
 
	$GameDB[roles] = new GameDBD();
	$GameDB[roles]->connect("roles", "SELECT * FROM roles ORDER BY roleid ASC");
	
 
// get all products from products table
$fid = $_REQUEST[fid];
$result = mysql_query("SELECT * FROM chats WHERE dst='$fid' AND type='Guild' ORDER BY cid DESC LIMIT 0,250") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["factionchats"] = array();
    while ($row = mysql_fetch_array($result)) {
		$src = $row[src];
		$role = $GameDB[roles]->searchBy("roleid", $src);

		$row[msg] = str_replace("\"","'", base64_decode($row[msg]));
		$row[msg] = str_replace("\\u0000","", $row[msg]);
		$row[msg] = $role[name].": ".str_replace("\u0000","", $row[msg]);
        array_push($response["factionchats"], $row);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No faction chats found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
