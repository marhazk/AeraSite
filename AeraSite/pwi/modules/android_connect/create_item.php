<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_REQUEST['roleid']) && isset($_REQUEST['itemid']) && isset($_REQUEST['total'])) {
 
    $roleid = $_REQUEST['roleid'];
    $itemid = $_REQUEST['itemid'];
    $total = $_REQUEST['total'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
	
    $result = mysql_query("INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('0', '".$roleid."', '0', '".$itemid."', '".$total."', '".$total."', 'Android', 'Sent by Android GM User', '0', '0', '0', '', NOW());");
    //$result = mysql_query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Item successfully added.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} 
else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>