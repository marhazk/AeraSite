<?php
	$op3 = $_REQUEST["topup"];
	if ($op3 == "Add")
	{
		if ($_REQUEST[topupuid] >= 32)
			$topupuid = $_REQUEST[topupuid];
		else
			$topupuid = $_REQUEST[topupuid2];
		$details = aerapointAddcode($null, $topupuid, $_REQUEST[topupamount], $_REQUEST[topupprice], $_REQUEST[topupgroup], $_REQUEST[topupmsg], $_REQUEST[topupbyuid]);
		if ($details["success"])
		{
			if ($_REQUEST[topupgroup] == "E")
			{
				
				$uWeb_topupvinfo = getuserdb("ID", $_REQUEST[topupuid]);
				$currMonth = mmonth(time());
				$lastMonth = mmonth($uWeb_topupvinfo["ncdlastpurchase"]);
				$chkNewMonth1 = $lastMonth;
				$chkNewMonth2 = $lastMonth+1;
				$chkNewMonth3 = $lastMonth-11;
				$uWeb_topupvinfo["ncdlastpurchase"] = time();
				if ($currMonth == $chkNewMonth1)
				{
					$uWeb_topupvinfo["ncdamount"] = $uWeb_topupvinfo["ncdamount"] + $_REQUEST[topupprice];
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
					$uWeb_topupvinfo["ncdamount"] = $_REQUEST[topupprice];
				}
				else
				{
					$uWeb_topupvinfo["ncdamount"] = $_REQUEST[topupprice];
					$uWeb_topupvinfo["ncdpoint"] = 0;
				}
				$ncdSql = "UPDATE users SET ncdlastpurchase='".$uWeb_topupvinfo["ncdlastpurchase"]."', ncdpoint='".$uWeb_topupvinfo["ncdpoint"]."', ncdamount='".$uWeb_topupvinfo["ncdamount"]."' WHERE ID='".$uWeb_topupvinfo["ID"]."'";
				mysql_query($ncdSql);
				$uWeb_tuser = getuserdb("ID", $_REQUEST[topupuid]);
				$uWeb_mailto = $uWeb_tuser[email];
				$uWeb_mailfrom = "sales@".$emailHost; //sender 
				$uWeb_mailhead = "PWAera Topup System <sales@".$emailHost.">";
				$subject = 'Top-up Aerapoint for '.$uWeb_tuser[name];
				$message = 'Dear Mr/Mrs '. $uWeb_tuser[fname] .' '. $uWeb_tuser[lname] .' ('. $uWeb_tuser[name] .'),'. "\r\n" .''. "\r\n" .'Thank you for purchasing and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. You have purchased top-up AeraPoint serial id '.$details[serial].' amount '.($details["cash"]/100).' Aeragold or Aerapoint. You may topup at website along with this top-op code.'. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.my/ for more information, for forum visit http://forum.perfectworld.my/'. "\r\n" .''. "\r\n" .'Regards,'. "\r\n" .'[AUTO] Aerapoint Transaction System';
				include "modules/mailer.php";
				$topupmsg = $details["serial"]." with amount ".$details["cash"]." has been added into AeraPointDB and emailed to ".$uWeb_tuser[name];
			}
			else
				$topupmsg = $details["serial"]." with amount ".$details["cash"]." has been added into AeraPointDB";
		}
		else
		{
			$topupmsg = $details["serial"]." with amount ".$details["cash"]." failed to be added into AeraPointDB ";
		}
	}
	die($topupmsg);
?>