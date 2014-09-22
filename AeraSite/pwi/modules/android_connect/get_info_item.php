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
$iid = $_REQUEST[iid];
$result = mysql_query("SELECT * FROM itemlist WHERE iid=$iid") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["items"] = array();
	$startVal = array();
	$num = 0;
    $row = mysql_fetch_array($result);
		
	$data = array();
	$datax = array();
	
		$row[iname] = uchr($row[iname]);
		$row[iname] = str_replace(";","",str_replace("&#", "", uchr($row[iname])));
		
		
		$datax[id] = 0;
		$datax[text] = " ";
        array_push($response["items"], $datax);
        array_push($response["items"], $datax);
		
		$data[id] = 1;
		$data[text] = "Item Detail for ".$row[iname];
        array_push($response["items"], $data);
        array_push($response["items"], $datax);
		
		$data[id] = 10;
		$data[text] = "Item ID :";
        array_push($response["items"], $data);
		$data[id] = 11;
		$data[text] = $row[iid];
        array_push($response["items"], $data);
        array_push($response["items"], $datax);
		
		$data[id] = 12;
		$data[text] = "Name :";
        array_push($response["items"], $data);
		$data[id] = 13;
		$data[text] = $row[iname];
        array_push($response["items"], $data);
        array_push($response["items"], $datax);
		
		
		$data[id] = 13;
		$data[text] = str_replace("<br>",chr(10).chr(13),$row[iinfo]);
		$data[text] = str_replace("<br/>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("<br />",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</div>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</div />",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</div/>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</h1>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</h2>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</h3>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</span>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</span/>",chr(10).chr(13),$data[text]);
		$data[text] = str_replace("</span />",chr(10).chr(13),$data[text]);
		$data[text] = strip_tags($data[text]);
        array_push($response["items"], $data);


    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No item found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
