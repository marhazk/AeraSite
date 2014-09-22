<?php
	echo "This module is under maintainance";
	// Celestial Reborn
	//
	$cr_enable = 1;
	$cr_noerr = 1;
	$crout = "";
	
	// Requirements
	$crreq_role = 48;				// Role ID
	$crreq_lvl = 130;				// Level
	$crreq_taskcomplete = 500;		// Task Complete
	$crreq_sp = 10000000;			// SP
	$crreq_rep = 36000;				// Reputation
	$crreq_gold = 20000000;			// Gold
	$crreq_culti1 = 22;				// Culti : 
	$crreq_culti2 = 32;				// Culti : 
	
	// After meet requirements, once CR
	$cr_lvl = 1;
	$cr_attackrate = 10;
	$cr_culti1 = 30;
	$cr_culti2 = 20;
	$cr_ap = 5;
	$cr_str = 5;
	$cr_dex = 5;
	$cr_int = 5;
	$cr_vit = 5;
	$cr_posx = 1295;
	$cr_posy = 796;
	$cr_posz = 1006;
	
	// Process
	if ($cr_enable)
	{
		if ($uWeb_rinfo["roleid"] <= $crreq_role)
		{
			$crout .= "<BR>ERROR : You have not meet the Celestial Reborn Role ID requirement";
			$cr_noerr = 0;
		}
		if ($uWeb_rinfo["rolelevel"] < $crreq_lvl)
		{
			$crout .= "<BR>ERROR : You have not meet the Celestial Reborn level requirement. CR Level Requirement : $crreq_lvl";
			$cr_noerr = 0;
		}
		if ($uWeb_rinfo["taskcomplete"] < $crreq_taskcomplete)
		{
			$crout .= "<BR>ERROR : You have not meet the Celestial Reborn Role Tasks requirement. CR Task Completion Requirement : $crreq_taskcomplete";
			$cr_noerr = 0;
		}
		if ($uWeb_rinfo["rolesp"] <= $crreq_sp)
		{
			$crout .= "<BR>ERROR : You have not meet the Celestial Reborn Role SP requirement. CR SP Requirement : $crreq_sp";
			$cr_noerr = 0;
		}
		if ($uWeb_rinfo["rolerep"] <= $crreq_rep)
		{
			$crout .= "<BR>ERROR : You have not meet the Celestial Reborn Role Reputation requirement. CR Reputation Requirement : $crreq_rep";
			$cr_noerr = 0;
		}
		if ($uWeb_rinfo["rolemoney"] <= $crreq_gold)
		{
			$crout .= "<BR>ERROR : You have not meet the Celestial Reborn Role Money requirement. CR Money Requirement : $crreq_gold";
			$cr_noerr = 0;
		}
		if ($uWeb_rinfo["roleculti"] <= 8)
		{
			$crout .= "<BR>ERROR : Your cultivation is low. Please make sure you finished your Daimon/Holy cultivation";
			$cr_noerr = 0;
		}
		if (($uWeb_rinfo["roleculti"] >= 20) && ($uWeb_rinfo["roleculti"] <= 21))
		{
			$crout .= "<BR>ERROR : Your cultivation is still low. Please make sure you finished your Holy cultivation.";
			$cr_noerr = 0;
		}
		if (($uWeb_rinfo["roleculti"] >= 30) && ($uWeb_rinfo["roleculti"] <= 31))
		{
			$crout .= "<BR>ERROR : Your cultivation is still low. Please make sure you finished your Daimon cultivation.";
			$cr_noerr = 0;
		}
		if ($cr_noerr)
		{
			mysql_query("UPDATE users SET rebornnow=");
		}
		echo
			$crout .= "";
	}
	else
		$crout .= "<BR>ERROR : This module is under maintainance";
?>