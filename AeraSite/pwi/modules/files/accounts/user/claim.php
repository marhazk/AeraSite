<?php
$cid = $_REQUEST[cid];
include "modules/accounts/user/vinfo.php";
if (($roleid >= $chkid) && ($roleid <= ($chkid+16)))
{
	if ($cid == 1)
	{
		$claimlvlreq = 60;
		$claimlvlreward = 100;
		$claimattid = "claim".$cid;
		if ($uWeb_rinfo[battlepower] >= $claimlvlreq)
		{
			if ($uWeb_rinfo[$claimattid] != 1)
			{
				if (addcashbyroleid($uWeb_rinfo[roleid], $claimlvlreward) == 1)
				{
					$claimquery = mysql_query("UPDATE uwebplayers SET ".$claimattid."=1 WHERE roleid=".$uWeb_rinfo[roleid]);
					//$test = "UPDATE uwebplayers SET ".$claimattid."=1 WHERE roleid=".$uWeb_rinfo[roleid];
					//die($test);
					echo "<P>Congratulation! You received $claimlvlreward Aerapoint Top-up Code.</P>";
					$temp = aerapointAddcash($chkid, $uWeb_rinfo[mentorid], 50);
				}
				else
				{
					echo "<P>Error to claim. Please contact administrator for more information.</P>";
				}
			}
			else
			{
				echo "<P>Fail to claim. You already claim this reward under this character. Please work hard again to regain more rewards.</p>";
			}
		}
		else if ($uWeb_rinfo[battlepower] < $claimlvlreq)
		{
			echo "<P>Fail to claim. You still not reach BattlePower (BP) $claimlvlreq. Please work hard to regain this rewards.</p>";
		}
		else
		{
			echo "<P>Fail to claim. You already claim this reward under this character. Please work hard again to regain more rewards.</p>";
		}
	}
	else if ($cid == 2)
	{
		$claimlvlreq = 170;
		$claimlvlreward = 100;
		$claimattid = "claim".$cid;
		if ($uWeb_rinfo[battlepower] >= $claimlvlreq)
		{
			if ($uWeb_rinfo[$claimattid] != 1)
			{
				if (addcashbyroleid($uWeb_rinfo[roleid], $claimlvlreward) == 1)
				{
					$claimquery = mysql_query("UPDATE uwebplayers SET ".$claimattid."=1 WHERE roleid=".$uWeb_rinfo[roleid]);
					echo "<P>Congratulation! You received $claimlvlreward Aerapoint Top-up Code.</P>";
					$temp = aerapointAddcash($chkid, $uWeb_rinfo[mentorid], 100);
				}
				else
				{
					echo "<P>Error to claim. Please contact administrator for more information.</P>";
				}
			}
			else
			{
				echo "<P>Fail to claim. You already claim this reward under this character. Please work hard again to regain more rewards.</p>";
			}
		}
		else if ($uWeb_rinfo[battlepower] < $claimlvlreq)
		{
			echo "<P>Fail to claim. You still not reach BattlePower (BP) $claimlvlreq. Please work hard to regain this rewards.</p>";
		}
		else
		{
			echo "<P>Fail to claim. You already claim this reward under this character. Please work hard again to regain more rewards.</p>";
		}
	}
	else
	{
		echo "<P>Unknown claim ID.</p>";
	}
}
else
	echo "<P>ERROR: You are not the owner of this character.</P>";
?>