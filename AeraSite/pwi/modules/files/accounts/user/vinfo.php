<?php

	// ////////////////////////////////////////////
	//
	// Automated Player Character Info
	//
	// ////////////////////////////////////////////
$uWeb_rqinfo = mysql_query("SELECT * FROM roles WHERE roleid=$roleid LIMIT 0,1");
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
	$vinfo = $uWeb_rinfo;
	include "modules/files/accounts/user/level.php";

	$vinfo[quest] = 18730;
	$vinfo[exp1] = $uWeb_rinfo["exppct"];
	$vinfo[exp2] = (int)(100-$uWeb_rinfo["exppct"]);
	$ocupation = occupation($uWeb_rinfo[occupation]);
	$ocupationtit = str_replace(".png", "", $ocupation);
	$uWeb_rinfo_class = '<img src="WEB-INF/img/'.$ocupation.'" title="'.$ocupationtit.'" alt="'.$ocupationtit.'" height="17" width="17" />';
	
	$vinfo[roleclass2] = $uWeb_rinfo_class;
	$vinfo[level2] = getculti($uWeb_rinfo["level2"]);
	$vinfo[tc1] = (float)(($uWeb_rinfo["taskcomplete"]/18730)*100);
	$vinfo[tc2] = $uWeb_rinfo["taskcomplete"];
	$vinfo[tt1] = (float)(($uWeb_rinfo["taskdata"]/18730)*100);
	$vinfo[tt2] = $uWeb_rinfo["taskdata"];
	//$uWeb_rinfo["battlepower"] = (int)(($uWeb_rinfo["taskcomplete"]/9365)*500)+(int)(($uWeb_rinfo["rolerep"]/500000)*100)+(int)($uWeb_rinfo["roleculti"])+(int)($uWeb_rinfo["rolelevel"]);
	$vinfo[repuser] = ($uWeb_rinfo["rolerep"]-35000);
	$vinfo[gender] = getgender($uWeb_rinfo["gender"]);
	$vinfo[lastlogin_time] = date('l jS \of F Y h:i:s A',$uWeb_rinfo["lastlogin_time"]);
	$vinfo[create_time] = date('l jS \of F Y h:i:s A',$uWeb_rinfo["create_time"]);
	
	// CLAIM SYSTEM
	
	if ($uWeb_rinfo["claim1"])
		$vinfo[rewards] = "[BP60 CLAIMED]";
	else	
		$vinfo[rewards] = "[<a href=?op=accounts&type=claim&cid=1&roleid=".$uWeb_rinfo[roleid].">CLAIM BL60</a>]";
	echo "<BR>";
	if ($uWeb_rinfo["claim2"])
		$vinfo[rewards] .= "[BP170 CLAIMED]";
	else	
		$vinfo[rewards] .= "[<a href=?op=accounts&type=claim&cid=2&roleid=".$uWeb_rinfo[roleid].">CLAIM BP170</a>]";

	// REBORN SYSTEM
	$vinfo[cr] = "[<a href=?op=accounts&type=reborn&roleid=".$uWeb_rinfo[roleid].">CELESTIAL REBORN NOW</a>]";
	include "modules/files/accounts/user/vinfonew.php";
	echo "<table width=80%>";
	if ($gmuser >= 5)
		include "modules/files/accounts/user/vinfogm.php";
	echo "</table>";
	$uWeb_chardb[uid] = $uWeb_vrinfo[ID];
	//include "modules/files/accounts/user/buypoint.php";
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