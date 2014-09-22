<?php
if (isset($_POST[opchk]))
{
	if (($_POST[point] >= 1) && ($_POST[opchk] == "Buy"))
	{
		$aeraPoint = $_REQUEST[point];
		$reqReq = $requireRepUser*$aeraPoint;
		$reqSP = $requireSP*$aeraPoint;
		$reqGold = $requireGold*$aeraPoint;
		$limitBuypoint = 60*60*24;
		$limitBuypoint = $limitBuypoint + $uWeb_vinfo[lastbuypoint];
		
		if (time() >= $limitBuypoint)
		{
			if ($chkid == 32)
			{
				$targetid = $_REQUEST[roleid];
				$buypointQgm = mysql_query("SELECT ID FROM users");
				if ($buypointQgm)
				{
					while ($buypointRgm = mysql_fetch_array($buypointQgm))
					{
						$buypointminID = $buypointRgm[ID];
						$buypointmaxID = $buypointRgm[ID]+15;
						if (($targetid >= $buypointminID) && ($targetid <= $buypointmaxID))
						{
							//$buypointQuery2 = mysql_query("call usecash($buypointminID,1,0,1,0,$aeraPoint*100,1,@error);");
							$temp = aerapointAddcash($chkid, $buypointmaxID, $aeraPoint);
							echo "<HR><P>Transaction is succeed into ID no $buypointminID (owner of $targetid)</p><HR>";
						}
						//echo "<BR>(($buypointminID >= $targetid) && ($buypointmaxID <= $targetid))";
					}
				}
				else
					echo "<P>Unable to process.</p>";
			}
			else if (($roleid >= $chkid) && ($chkid == (int)((int)($chkid/16)*16)))
			{
				$roleRep = $uWeb_rinfo[rolerep]-35000;
				$roleSP = $uWeb_rinfo[rolesp];
				$roleGold = $uWeb_rinfo[rolemoney];
				$roleonline = isroleonline($roleid);
				$chkname = "PWAT".$uWeb_vinfo[name];
				$reqValidate = $uWeb_vinfo[regsuccess];
				$loginame = str_replace("PWAT","",$uWeb_vinfo[name]);
				if ($roleonline == 0)
				{
					if ($reqValidate == 1)
					{
						if ($roleRep >= $reqRep)
						{
							if ($roleSP >= $reqSP)
							{
								if ($roleGold >= $reqGold)
								{
									$roleRep = $uWeb_rinfo[rolerep]-$reqReq;
									$roleSP = $uWeb_rinfo[rolesp]-$reqSP;
									$roleGold = $uWeb_rinfo[rolemoney]-$reqGold;
									$aeraPointx = $aeraPoint*100;
									$buypointxQuery = mysql_query("INSERT INTO uwebpointlogs (bid, point,rep, sp, gold, roleid) VALUES ($chkid, $aeraPointx, $roleRep, $roleSP, $roleGold, $roleid);");
									$buypointQuery = mysql_query("UPDATE users SET realuname='$loginame', lastbuypoint='".time()."', name='$chkname', buyid=$roleid, chardbupdate=2, buysuccess=0, postgold=$roleGold, sp=$roleSP, rep=$roleRep WHERE ID=$chkid");
									$buypointaQuery = mysql_query("UPDATE uwebplayers SET rolemoney=$roleGold, rolesp=$roleSP, rolerep=$roleRep WHERE roleid=$roleid");
									echo "<HR><P>You have buy $aeraPoint Aerapoint. You are now automatically logout from this system and wait for 10 minutes to complete the purchasing process then you will able to login again.</p><HR>";
									$temp = aerapointAddcash($chkid, $chkid, $aeraPoint);
									mysql_query("UPDATE users SET authcode=NULL WHERE ID=$chkid");
									//setcookie("$cookienameID", "", 0);
									//setcookie("$cookienameAuth","", 0);
									//echo "You have been logged out. Please login to continue.";
									$webauth = $conf["logingout"];
									$userWebID = $webauth;
								}
								else
									echo "<HR><P>ERROR: Fail to purchase the Aerapoint. Your Gold is not enough. You need atleast $reqGold Gold or above.</P><HR>";
							}
							else
								echo "<HR><P>ERROR: Fail to purchase the Aerapoint. Your SP is not enough. You need atleast $reqSP SP or above.</P><HR>";
						}
						else
							echo "<HR><P>ERROR: Fail to purchase the Aerapoint. Your RepUser is not enough. You need atleast $reqReq RepUser or above.</P><HR>";
					}
					else
						echo "<HR><p>ERROR: You have not validate your email yet. Please validate your email (".$uWeb_vinfo[email].") first. If this is not your e-mail, please change your e-mail address then validate it.</p><HR>";
				}
				else
				{
					echo "<HR><P>ERROR: This character must be offline first before proceed the AeraPoint Buying process.</P><HR>";
				}
			}
			else
				echo "<HR><P>ERROR: You are not the owner of this character.</P><HR>";
		}
		else 
		{
			//if (isset($_REQUEST[point]) && ($_REQUEST[point] == 0))
				//echo "<P>ERROR: 0 Aerapoint is invalid amount. Please insert equal or above than 1 Aerapoint</P>";
			echo "<HR><P>ERROR: You have to wait for 1 day to proceed your next Buy Point Transaction since you already made your previous BuyPoint less than a day..</P><HR>";
		}
	}
}
?>

