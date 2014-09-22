<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_REQUEST['bid']) && isset($_REQUEST['payment']) && isset($_REQUEST['cash']) && isset($_REQUEST['cgroup'])) {
 	$bid = $_REQUEST[bid];
	$payment = $_REQUEST[payment];
	$cash = $_REQUEST[cash];
	$cgroup = strtoupper($_REQUEST[cgroup]);
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
	include "../functions.php";
	include "../aerapoint.php";
    // mysql inserting a new row

		$details = aerapointAddcode($null, $bid, $cash, $payment, $cgroup, "ADDED WITH ANDROID", 0);
		if ($details["success"])
		{
			if ($cgroup == "E")
			{
				
				$uWeb_topupvinfo = getuserdb("ID", $bid);
				$currMonth = mmonth(time());
				$lastMonth = mmonth($uWeb_topupvinfo["ncdlastpurchase"]);
				$chkNewMonth1 = $lastMonth;
				$chkNewMonth2 = $lastMonth+1;
				$chkNewMonth3 = $lastMonth-11;
				$uWeb_topupvinfo["ncdlastpurchase"] = time();
				if ($currMonth == $chkNewMonth1)
				{
					$uWeb_topupvinfo["ncdamount"] = $uWeb_topupvinfo["ncdamount"] + $payment;
				}
				else if (($currMonth == $chkNewMonth2) || ($currMonth == $chkNewMonth3))
				{	
					if ($uWeb_topupvinfo["ncdamount"] >= 100)
					{
						$uWeb_topupvinfo["ncdpoint"] = $uWeb_topupvinfo["ncdpoint"] + 5;
					}
					else if ($uWeb_topupvinfo["ncdamount"] >= 50)
					{
						$uWeb_topupvinfo["ncdpoint"] = $uWeb_topupvinfo["ncdpoint"] + 1;
					}
					$uWeb_topupvinfo["ncdamount"] = $payment;
				}
				else
				{
					$uWeb_topupvinfo["ncdamount"] = $payment;
					$uWeb_topupvinfo["ncdpoint"] = 0;
				}
				$ncdSql = "UPDATE users SET ncdlastpurchase='".$uWeb_topupvinfo["ncdlastpurchase"]."', ncdpoint='".$uWeb_topupvinfo["ncdpoint"]."', ncdamount='".$uWeb_topupvinfo["ncdamount"]."' WHERE ID='".$uWeb_topupvinfo["ID"]."'";
				mysql_query($ncdSql);
				$uWeb_tuser = getuserdb("ID", $bid);
				$uWeb_mailto = $uWeb_tuser[email];
				$uWeb_mailfrom = "sales@perfectworld.my"; //sender 
				$uWeb_mailhead = "PWAera Topup System <sales@perfectworld.my>";
				$subject = 'Top-up Aerapoint for '.$uWeb_tuser[name];
				$message = 'Dear Mr/Mrs '. $uWeb_tuser[fname] .' '. $uWeb_tuser[lname] .' ('. $uWeb_tuser[name] .'),'. "\r\n" .''. "\r\n" .'Thank you for purchasing and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. You have purchased top-up AeraPoint serial id '.$details[serial].' amount '.($details["cash"]/100).' Aeragold or Aerapoint. You may topup at website along with this top-op code.'. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.my/ for more information, for forum visit http://forum.perfectworld.my/'. "\r\n" .''. "\r\n" .'Regards,'. "\r\n" .'[AUTO] Aerapoint Transaction System';
				include "../mailer.php";
				$result = 1;
			}
			else
				$result = 1;
		}
		else
		{
				$result = 0;
		}
	
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Topup successfully added.";
 
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