<?php

	// ////////////////////////////////////////////
	//
	// Automated Player Character Info
	//
	// ////////////////////////////////////////////
$uWeb_rqinfo = mysql_query("SELECT * FROM uwebplayers WHERE roleid=$roleid LIMIT 0,1");
$uWeb_vrqinfo = mysql_query("SELECT * FROM users WHERE ID=".getuidbyrole($roleid)." LIMIT 0,1");
if ($uWeb_rqinfo)
{
	$uWeb_rinfo = mysql_fetch_array($uWeb_rqinfo);
	$uWeb_vrinfo = mysql_fetch_array($uWeb_vrqinfo);

	//$requireSP = (int)($requireSP/(150*4-($uWeb_rinfo[rolelevel]*4)));
	//$requireGold = (int)($requireGold/(150*4-($uWeb_rinfo[rolelevel]*4)));
	
	
	// ////////////////////////////////////////////
	//
	// Manual Player Character Info
	//
	// ////////////////////////////////////////////

	echo "<table width=80%>";
	echo "<TR><td valign=top width=30%>Character Name : </b></td><td valign=top width=70%> ".$uWeb_rinfo["rolename"]."</td></tr>";
	
	include "modules/accounts/user/level.php";
	echo "<TR><td valign=top width=30%><b>Character Level :</b></td><td valign=top width=70%> ".$uWeb_rinfo["rolelevel"]."</td></tr>";
	echo "<tr><td valign=top width=30%><B>Experience :</b></td><td valign=top width=70%> ".$uWeb_rinfo["exppct"]."% completed (".(int)(100-$uWeb_rinfo["exppct"])."% more to gain level ".(int)($uWeb_rinfo["rolelevel"]+1).") </td></tr>";
	echo "<TR><td valign=top width=30%><b>Class :</b></td><td valign=top width=70%>";
	if ($uWeb_rinfo["roleclass"] == 0)
	{
		$uWeb_rinfo_class = "MG - Magician/Wizard";
		$uWeb_rinfo_class_na = "<option value=0>-</option>";
		$uWeb_rinfo_class_wr = "<option value=1>WR</option>";
		$uWeb_rinfo_class_mg = "<option value=2 selected>MG</option>";
		$uWeb_rinfo_class_ea = "<option value=3>EA</option>";
		$uWeb_rinfo_class_ep = "<option value=4>EP</option>";
		$uWeb_rinfo_class_wb = "<option value=5>WB</option>";
		$uWeb_rinfo_class_wf = "<option value=6>WF</option>";
	}
	elseif ($uWeb_rinfo["roleclass"] == 1)
	{
		$uWeb_rinfo_class = "WR - Warrior/Blademaster";
		$uWeb_rinfo_class_na = "<option value=0>-</option>";
		$uWeb_rinfo_class_wr = "<option value=1 selected>WR</option>";
		$uWeb_rinfo_class_mg = "<option value=2>MG</option>";
		$uWeb_rinfo_class_ea = "<option value=3>EA</option>";
		$uWeb_rinfo_class_ep = "<option value=4>EP</option>";
		$uWeb_rinfo_class_wb = "<option value=5>WB</option>";
		$uWeb_rinfo_class_wf = "<option value=6>WF</option>";
	}
	elseif ($uWeb_rinfo["roleclass"] == 2)
	{
		$uWeb_rinfo_class = "WB - WereBeast/Barbarian";
		$uWeb_rinfo_class_na = "<option value=0>-</option>";
		$uWeb_rinfo_class_wr = "<option value=1>WR</option>";
		$uWeb_rinfo_class_mg = "<option value=2>MG</option>";
		$uWeb_rinfo_class_ea = "<option value=3>EA</option>";
		$uWeb_rinfo_class_ep = "<option value=4>EP</option>";
		$uWeb_rinfo_class_wb = "<option value=5 selected>WB</option>";
		$uWeb_rinfo_class_wf = "<option value=6>WF</option>";
	}
	elseif ($uWeb_rinfo["roleclass"] == 3)
	{
		$uWeb_rinfo_class = "WF - WereFox/Venomancer";
		$uWeb_rinfo_class_na = "<option value=0>-</option>";
		$uWeb_rinfo_class_wr = "<option value=1>WR</option>";
		$uWeb_rinfo_class_mg = "<option value=2>MG</option>";
		$uWeb_rinfo_class_ea = "<option value=3>EA</option>";
		$uWeb_rinfo_class_ep = "<option value=4>EP</option>";
		$uWeb_rinfo_class_wb = "<option value=5>WB</option>";
		$uWeb_rinfo_class_wf = "<option value=6 selected>WF</option>";
	}
	elseif ($uWeb_rinfo["roleclass"] == 4)
	{
		$uWeb_rinfo_class = "EA - ElfArcher/Archer";
		$uWeb_rinfo_class_na = "<option value=0>-</option>";
		$uWeb_rinfo_class_wr = "<option value=1>WR</option>";
		$uWeb_rinfo_class_mg = "<option value=2>MG</option>";
		$uWeb_rinfo_class_ea = "<option value=3 selected>EA</option>";
		$uWeb_rinfo_class_ep = "<option value=4>EP</option>";
		$uWeb_rinfo_class_wb = "<option value=5>WB</option>";
		$uWeb_rinfo_class_wf = "<option value=6>WF</option>";
	}
	elseif ($uWeb_rinfo["roleclass"] == 5)
	{
		$uWeb_rinfo_class = "EP - ElfPriest/Cleric";
		$uWeb_rinfo_class_na = "<option value=0>-</option>";
		$uWeb_rinfo_class_wr = "<option value=1>WR</option>";
		$uWeb_rinfo_class_mg = "<option value=2>MG</option>";
		$uWeb_rinfo_class_ea = "<option value=3>EA</option>";
		$uWeb_rinfo_class_ep = "<option value=4 selected>EP</option>";
		$uWeb_rinfo_class_wb = "<option value=5>WB</option>";
		$uWeb_rinfo_class_wf = "<option value=6>WF</option>";
	}
	
	
	else 
	{
		$uWeb_rinfo_class = "N/A";
		$uWeb_rinfo_class_na = "<option value=0 selected>-</option>";
		$uWeb_rinfo_class_wr = "<option value=1>WR</option>";
		$uWeb_rinfo_class_mg = "<option value=2>MG</option>";
		$uWeb_rinfo_class_ea = "<option value=3>EA</option>";
		$uWeb_rinfo_class_ep = "<option value=4>EP</option>";
		$uWeb_rinfo_class_wb = "<option value=5>WB</option>";
		$uWeb_rinfo_class_wf = "<option value=6>WF</option>";
	}
	//echo "$uWeb_rinfo_class - <SELECT name=roleclass>";
	//echo $uWeb_rinfo_class_na;
	//echo $uWeb_rinfo_class_wr;
	//echo $uWeb_rinfo_class_mg;
	//echo $uWeb_rinfo_class_ea;
	//echo $uWeb_rinfo_class_ep;
	//echo $uWeb_rinfo_class_wb;
	//echo $uWeb_rinfo_class_wf;
	//echo "</select>";
	//echo "<TR><td valign=top width=30%><b> :</b></td><td valign=top width=70%> ".$uWeb_rinfo["role"];
	echo $uWeb_rinfo_class."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Agility/Dex :</b></td><td valign=top width=70%> ".$uWeb_rinfo["roleagi"]."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Vitality :</b></td><td valign=top width=70%> ".$uWeb_rinfo["rolevit"]."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Int/Mag :</b></td><td valign=top width=70%> ".$uWeb_rinfo["roleint"]."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Strength :</b></td><td valign=top width=70%> ".$uWeb_rinfo["rolestr"]."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Cultivation :</b></td><td valign=top width=70%> ".getculti($uWeb_rinfo["roleculti"])."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Task Completion :</b></td><td valign=top width=70%> ".(float)(($uWeb_rinfo["taskcomplete"]/18730)*100)."% (".$uWeb_rinfo["taskcomplete"]." quests out of 18730 quests)"."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Task Taken :</b></td><td valign=top width=70%> ".(float)(($uWeb_rinfo["taskdata"]/18730)*100)."% (".$uWeb_rinfo["taskdata"]." quests out of 18730 quests)"."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Bank :</b></td><td valign=top width=70%> ".$uWeb_rinfo["rolebank"]."</td></tr>";
	
	
	//$uWeb_rinfo["battlepower"] = (int)(($uWeb_rinfo["taskcomplete"]/9365)*500)+(int)(($uWeb_rinfo["rolerep"]/500000)*100)+(int)($uWeb_rinfo["roleculti"])+(int)($uWeb_rinfo["rolelevel"]);
	echo "<TR><td valign=top width=30%><b>BattlePower :</b></td><td valign=top width=70%> ".$uWeb_rinfo["battlepower"]."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Buy 1,000,000 Gold:</b></td><td valign=top width=70%> [BUY GOLD]<BR>(requires 1 Point)</td></tr>";
	echo "<TR><td valign=top width=30%><b>Reputation :</b></td><td valign=top width=70%> RepUser ".($uWeb_rinfo["rolerep"]-35000)." + RepBasic 35000"."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Skill Points :</b></td><td valign=top width=70%> ".$uWeb_rinfo["rolesp"]."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Money :</b></td><td valign=top width=70%> ".$uWeb_rinfo["rolemoney"]."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Buy AeraPoint :</b></td><td valign=top width=70%> [<a href=?op=accounts&type=buypoint&roleid=".$uWeb_rinfo[roleid].">BUY POINT</a>]<BR><B>(requires $requireRepUser RepUser, $requireSP SP, $requireGold Gold)</B></td></tr>";
	echo "<TR><td valign=top width=30%><b>Gender :</b></td><td valign=top width=70%> ".getgender($uWeb_rinfo["rolegender"])."</td></tr>";


	echo "<TR><td valign=top width=30%><b>Last Login:</b></td><td valign=top width=70%> ".date('l jS \of F Y h:i:s A',$uWeb_rinfo["lastlogin"])."</td></tr>";
	echo "<TR><td valign=top width=30%><b>Create Time:</b></td><td valign=top width=70%> ".date('l jS \of F Y h:i:s A',$uWeb_rinfo["createtime"])."</td></tr>";
	if ($uWeb_rinfo["online"] == 1)
		$uWeb_rinfo_dbtonline = "ONLINE";
	elseif ($uWeb_rinfo["online"] == 2)
		$uWeb_rinfo_dbtonline = "UNSTORED OFFLINE";
	else
		$uWeb_rinfo_dbtonline = "STORED OFFLINE";
	echo "<TR><td valign=top width=30%><b>Online Status:</b></td><td valign=top width=70%> $uWeb_rinfo_dbtonline"."</td></tr>";

	// CLAIM SYSTEM
	echo "<TR><td valign=top width=30%><b>AeraPoint Rewards:</b></td><td valign=top width=70%> ";
	if ($uWeb_rinfo["claim1"])
		echo "[LVL50 CLAIMED]";
	else	
		echo "[<a href=?op=accounts&type=claim&cid=1&roleid=".$uWeb_rinfo[roleid].">CLAIM LVL50 (will be no longer available till 31-May-2012)</a>]";
	echo "<BR>";
	if ($uWeb_rinfo["claim2"])
		echo "[LVL90 CLAIMED]";
	else	
		echo "[<a href=?op=accounts&type=claim&cid=2&roleid=".$uWeb_rinfo[roleid].">CLAIM LVL90 (will be no longer available till 31-May-2012)</a>]";
	echo "<BR>";
	if ($uWeb_rinfo["claim3"])
		echo "[LVL110 CLAIMED]";
	else	
		echo "[<a href=?op=accounts&type=claim&cid=3&roleid=".$uWeb_rinfo[roleid].">CLAIM LVL110 (will be no longer available till 31-May-2012)</a>]";
	echo "<BR>";
	if ($uWeb_rinfo["claim4"])
		echo "[LVL130 CLAIMED]";
	else	
		echo "[<a href=?op=accounts&type=claim&cid=4&roleid=".$uWeb_rinfo[roleid].">CLAIM LVL130 (will be no longer available till 31-May-2012)</a>]";
	echo "<BR>";
	if ($uWeb_rinfo["claim5"])
		echo "[LVL150 CLAIMED]";
	else	
		echo "[<a href=?op=accounts&type=claim&cid=5&roleid=".$uWeb_rinfo[roleid].">CLAIM LVL150 (will be no longer available till 31-May-2012)</a>]";
	echo "<BR>[CLAIM BP60-LVL50] (Coming soon)";
	echo "<BR>[CLAIM BP150-LVL100] (Coming soon)";


	// REBORN SYSTEM
	echo "</td></tr>";
	echo "<TR><td valign=top width=30%><b>Celestial Reborning (CR) (Requires Level 130 and BattlePower 200):</b></td><td valign=top width=70%> [<a href=?op=accounts&type=reborn&roleid=".$uWeb_rinfo[roleid].">CELESTIAL REBORN NOW</a>]"."</td></tr>";
	
	if ($gmuser >= 1)
		include "modules/accounts/user/vinfogm.php";
	echo "</table>";
	$uWeb_chardb[uid] = $uWeb_vrinfo[ID];
}
?>

<p><strong>Account Information</strong></p>
<table width="80%" border="0">
    <tr>
    <td width="40%" align="right" valign="top"><strong>Mentor/Game Promoter :</strong></td><td width="60%" align="left" valign="top"><?php echo getusername($uWeb_vrinfo["mentorid"]);?></td>
  </tr>
</table>
<p><strong>Student List</strong></p>
<table width="80%" border="0">

<?php
	$vinfosq = mysql_query("SELECT * FROM users WHERE mentorid='".getuidbyrole($uWeb_rinfo[roleid])."'");
	if ($vinfosq)
	{
		$vinfostudentnum = 0;
		while ($vinfosrow = mysql_fetch_array($vinfosq))
		{
			$vinfostudentnum++;
			$vinfostudentname = $vinfosrow["name"];
?>
    <tr>
    <td width="40%" align="right" valign="top"><strong>Student <?php echo $vinfostudentnum;?> out of 5 :</strong></td><td width="60%" align="left" valign="top"><?php echo $vinfostudentname;?></td>
  </tr>
  
<?php
		}
	}
?>
</table>