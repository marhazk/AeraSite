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
if ($_REQUEST[start] > 0)
	$startNum = $_REQUEST[start];
else if ($_REQUEST[start2] > 0)
	$startNum = $_REQUEST[start2]-50000;
else
	$startNum = 0;
if ($startNum < 0)
	$startNum = 0;
$searchID = $_REQUEST[iid];
$searchName = $_REQUEST[iname];
if ($searchID >= 1)
	$result = mysql_query("SELECT iid, iname FROM itemlist WHERE iid='".$searchID."' ORDER BY android DESC, iname ASC LIMIT $startNum,500;") or die(mysql_error());
else if (strlen($searchName) >= 1)
	$result = mysql_query("SELECT iid, iname FROM itemlist WHERE iname LIKE '%".$searchName."%' ORDER BY android DESC, iname ASC LIMIT $startNum,500;") or die(mysql_error());
else
	$result = mysql_query("SELECT iid, iname FROM itemlist ORDER BY android DESC, iname ASC LIMIT $startNum,500;") or die(mysql_error());
 
// check for empty result
$numrows = mysql_num_rows($result);
if ($numrows > 0) {
    // looping through all results
    // products node
    $response["items"] = array();
	$startVal = array();
	$num = 0;
	$total = mysql_num_rows($result);
			$startVal[iid] = "0";
			$startVal[iname] = "Total of Items: ".$total." items";
			array_push($response["items"], $startVal);
			$startVal[iid] = "0";
			$startVal[iname] = " ";
			array_push($response["items"], $startVal);
			if ($startNum >= 500)
			{
				//$startVal[iid] = 50000+$startNum-500;
				//$startVal[iname] = "<<< BACK";
				//array_push($response["items"], $startVal);
			}
    while ($row = mysql_fetch_array($result)) {
		
	$data = array();
		$num++;
		$row[iname] = $num.". ".uchr($row[iname]);
		$row[iname] = str_replace(";","",str_replace("&#", "", uchr($row[iname])));
		$data[iid] = $row[iid];
		$data[iname] = $row[iname];
        array_push($response["items"], $data);
    }
	if ($num >= 500)
	{
		$startVal[iid] = "0";
		$startVal[iname] = " ";
		array_push($response["items"], $startVal);
		$startVal[iid] = 50000+$startNum+$num;
		$startVal[iname] = "NEXT >>>";
		array_push($response["items"], $startVal);
		$startVal[iid] = "0";
		$startVal[iname] = " ";
		array_push($response["items"], $startVal);
	}
	if ($num == 0)
	{
		// success
		$response["success"] = 0;
   		$response["message"] = "No item found";
		// echoing JSON response
		echo json_encode($response);
	}
	else
	{
		// success
		$response["success"] = 1;
	 
		// echoing JSON response
		echo json_encode($response);
	}
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No item found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
