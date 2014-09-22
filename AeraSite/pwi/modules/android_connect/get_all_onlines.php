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
$result = mysql_query("SELECT * FROM roles, online WHERE roles.userid=online.Id ORDER BY roles.userid ASC") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["onlineroles"] = array();
	$a = 0;
	$b = 0;
    $_row = array();
	$numOnline = -1;
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $data = array();
		$a = $row["userid"]; 
		$b = $_row["userid"];
		$timea = strtotime($row["lastlogin_time"]);
		$timeb = strtotime($_row["lastlogin_time"]);
		if (($a > $b) || ($b == 0))
		{
			$_row = $row;
			$numOnline++;
			$dbTemp[$numOnline] = $row;
		}
		if (($a >= $b) && ($timea > $timeb))
		{
			$dbTemp[$numOnline] = $row;
		}
        //$data["roleid"] = $row["roleid"];
        //$data["name"] = $row["name"];
        //$data["userid"] = $row["userid"];
        //$data["level"] = $row["level"];
        //$data["lastlogin_time"] = $row["lastlogin_time"];
 
        // push single product into final response array
    }
	
	$startVal = array();
	$num = 0;
	$total = count($dbTemp);
	foreach ($dbTemp as $dbVal)
	{
		if ($num == 0)
		{
			$startVal = $dbVal;
			$startVal[ID] = 1;
			$startVal[name] = "Total Onlines: ".$total." players";
			array_push($response["onlineroles"], $startVal);
			$startVal[ID] = 2;
			$startVal[name] = " ";
			array_push($response["onlineroles"], $startVal);
		}
		$num++;
		$dbVal[name] = $num.". ".$dbVal[name]."\t\tLVL: ".$dbVal[level];
        array_push($response["onlineroles"], $dbVal);
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
