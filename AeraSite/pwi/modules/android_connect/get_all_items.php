<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
function uchr ($codes) {
        if (is_scalar($codes)) $codes= func_get_args();
        $str= '';
        foreach ($codes as $code) $str.= html_entity_decode('&#'.$code.';',ENT_NOQUOTES,'UTF-8');
        return $str;
    }
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table
//$result = mysql_query("SELECT * FROM itemlist WHERE android=1 ORDER BY iname ASC") or die(mysql_error());
$result = mysql_query("SELECT iid, iname FROM itemlist ORDER BY android DESC, iname ASC LIMIT 0,100;") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["items"] = array();
	$startVal = array();
	$num = 0;
	$total = mysql_num_rows($result);
    while ($row = mysql_fetch_array($result)) {
		
	$data = array();
		if ($num == 0)
		{
			$startVal = $row;
			$startVal[iid] = 0;
			$startVal[iname] = "Total of Items: ".$total." items";
			array_push($response["items"], $startVal);
			$startVal[iid] = 0;
			$startVal[iname] = " ";
			array_push($response["items"], $startVal);
		}
		$num++;
		$row[iname] = $num.". ".uchr($row[iname]);
		$row[iname] = str_replace(";","",str_replace("&#", "", uchr($row[iname])));
		$data[iid] = $row[iid];
		$data[iname] = $row[iname];
        array_push($response["items"], $data);
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
