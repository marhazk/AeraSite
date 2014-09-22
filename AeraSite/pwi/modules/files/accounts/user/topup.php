<?php
	$op3 = $_POST["topup"];
	if ($op3 == "Top-up Now")
	{
		if ($uWeb_vinfo[regsuccess] == 1)
		{
			if ($_POST[topuptype] == 1)
			{
				$details = aerapointTopup($chkid, $_POST["topupcode"]);
				if ($details["success"] == 10)
				{
					
					
					$topupmsg = "Congratulation! You have been topup ".($details["cash"]/100)." Aerapoint. Please relogin within 10 minutes to receive the Aerapoint";
					$uWeb_mailto = $uWeb_vinfo[email];
					$uWeb_mailfrom = "sales@".$emailHost; //sender 
					$uWeb_mailhead = "PWAera Topup System <sales@".$emailHost.">";
					$subject = 'Top-up Aerapoint for '.$uWeb_vinfo[name];
					$message = 'Thank you for purchasing and supporting Perfect World:Aera Malaysia (EuBo) 2012 edition. You have been top-up AeraPoint serial id '.$details[serial].' amount '.($details["cash"]/100).' Aeragold or Aerapoint.'. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.com.my/ for more information, for forum visit http://forum.perfectworld.com.my/';
					include "modules/mailer.php";
					
				}
				elseif ($details["success"] == 5)
				{
					$topupmsg = "ERROR: Fail to topup serial id ".($details["serial"]).". This coupon card is not for you.";
				}
				elseif ($details["success"] == 4)
				{
					$topupmsg = "ERROR: Fail to topup serial id ".($details["serial"]).". Unable to sync to the game server.";
				}
				elseif ($details["success"] == 3)
				{
					$topupmsg = "ERROR: Fail to topup. Unable to retrieve the coupon.";
				}
				elseif ($details["success"] == 2)
				{
					$topupmsg = "ERROR: Fail to topup serial id ".($details["serial"]).". Topup Coupon has been locked/banned.";
				}
				elseif ($details["success"] == 1)
				{
					$topupmsg = "ERROR: Fail to retrieve. Already topup or code already used. Top-up Serial Number : ".$details["serial"];
				}
				else
				{
					$topupmsg = "ERROR: Fail to topup. Unknown topup code.";
				}
			}
			else if ($_POST[topuptype] == 442)
			{
				$details = aerapointAddcode($null, $chkid, 0, 0, "E", "", 32, 2, $_POST["topupcode"]);
				$topupmsg = "Congratulation! You have been topup DiGi Topup Code into AeraPoint Code. Please wait for several minutes for the status...";
				$uWeb_mailto = $uWeb_vinfo[email];
				$uWeb_mailfrom = "sales@".$emailHost; //sender 
				$uWeb_mailhead = "PWAera Topup System <sales@".$emailHost.">";
				$subject = 'Top-up Aerapoint for '.$uWeb_vinfo[name];
				$message = 'Thank you for purchasing and supporting Perfect World:Aera Malaysia (EuBo) 2013 edition. You have been purchasing a AeraPoint Topup Code id '.$details[serial].'.'. "\r\n" .''. "\r\n" .' More info, visit http://www.perfectworld.com.my/ for more information, for forum visit http://forum.perfectworld.my/';
				include "modules/mailer.php";
			}
		}
		else
		{
			$topupmsg = "ERROR: Fail to topup. You have not validate your email yet. Please validate your email (".$uWeb_vinfo[email].") first. If this is not your e-mail, please change your e-mail address then validate it.";
		}
	}
	else if (($op3 == "Add All") && ($gmuser >= 5))
	{
		$numUser = 0;
		$sqlUser = mysql_query("SELECT * from users WHERE regsuccess=1");
		while ($rowUser = mysql_fetch_array($sqlUser))
		{
			$userID = $rowUser["ID"];
			$details = aerapointAddcode($null, $userID, $_POST[topupamount], $_POST[topupprice], $_POST[topupgroup], $_POST[topupmsg], $_POST[topupbyuid]);
			$numUser++;
		}
		$topupmsg = "Top-up Aerapoint Codes have been added into ".$numUser." users.";
	}
	else if (($op3 == "Add") && ($gmuser >= 5))
	{
		if ($_POST[topupuid] >= 32)
			$topupuid = $_POST[topupuid];
		else
			$topupuid = $_POST[topupuid2];
		$details = aerapointAddcode($null, $topupuid, $_POST[topupamount], $_POST[topupprice], $_POST[topupgroup], $_POST[topupmsg], $_POST[topupbyuid]);
		if ($details["success"])
		{
			if ($_POST[topupgroup] == "E")
			{
				
				$uWeb_topupvinfo = getuserdb("ID", $_POST[topupuid]);
				$currMonth = mmonth(time());
				$lastMonth = mmonth($uWeb_topupvinfo["ncdlastpurchase"]);
				$chkNewMonth1 = $lastMonth;
				$chkNewMonth2 = $lastMonth+1;
				$chkNewMonth3 = $lastMonth-11;
				$uWeb_topupvinfo["ncdlastpurchase"] = time();
				if ($currMonth == $chkNewMonth1)
				{
					$uWeb_topupvinfo["ncdamount"] = $uWeb_topupvinfo["ncdamount"] + $_POST[topupprice];
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
					$uWeb_topupvinfo["ncdamount"] = $_POST[topupprice];
				}
				else
				{
					$uWeb_topupvinfo["ncdamount"] = $_POST[topupprice];
					$uWeb_topupvinfo["ncdpoint"] = 0;
				}
				$ncdSql = "UPDATE users SET ncdlastpurchase='".$uWeb_topupvinfo["ncdlastpurchase"]."', ncdpoint='".$uWeb_topupvinfo["ncdpoint"]."', ncdamount='".$uWeb_topupvinfo["ncdamount"]."' WHERE ID='".$uWeb_topupvinfo["ID"]."'";
				mysql_query($ncdSql);
				$uWeb_tuser = getuserdb("ID", $_POST[topupuid]);
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

?>

<p><?php echo $topupmsg; ?></p>
<p>Howdy players! We announced you sales and free Aerapoint (AP) due New Pre-Launch update. The sales will be <strong>valid start 1 August 2013 till 31 August 2013 12:00am +8GMT</strong>. Players can purchase the Aerapoint Code via Direct Automated Transaction System or Online banking to:</p>
<ul>
  <li>Account number : 1610-3314-5191 </li>
</ul>
<ul>
  <li> Account type : Maybank</li>
</ul>
<ul>
  <li>Account Name : Marhazli</li>
</ul>
<br />
<br />
<ul>
    <li>Account number : 1115-0067-6125-22 </li>
</ul>
<ul>
    <li> Account type : CIMB</li>
</ul>
<ul>
    <li>Account Name : Marhazli</li>
</ul>
<br />
<br />
<ul>
    <li>Account number : 1101-3025-7282-67 </li>
</ul>
<ul>
    <li> Account type : Bank Islam</li>
</ul>
<ul>
    <li>Account Name : Marhazli</li>
</ul>
<br />
<br />
<ul>
    <li>Account number : 1310-0290-0063-3635 </li>
</ul>
<ul>
    <li> Account type : Bank Nasional</li>
</ul>
<ul>
    <li>Account Name : Marhazli</li>
</ul>
<p>Send yout receipt to sales@<?php echo $emailHost;?>. Below are the details of puchasing the Aerapoint</p>
<ul>
  <li><strong>RM 50 = 500 AeraGold  + Free 50 AeraGold</strong><strong> </strong>per purchases</li>
</ul>
<ul>
    <li><strong>RM 100 = 1000 AeraGold  + Free 150 AeraGold</strong><strong> </strong>per purchases</li>
</ul>
<ul>
    <li><strong>RM 150 = 1500 AeraGold  + Free 150 AeraGold</strong><strong> </strong>per purchases</li>
</ul>
<ul>
    <li><strong>RM 200 = 2000 AeraGold  + Free 300 AeraGold</strong><strong> </strong>per purchases</li>
</ul>
<p>* Notes : AeraGold (AG) is not AeraPoint (AP).</p>
<p>&nbsp;</p>

<h1>&nbsp;</h1>
<form method=post>
  <table width="80%" border="0">
  <tr>
<td width=30% valign=top align=right>Topup Code : </td> <td width=50% valign=top align=left><input type=text name=topupcode size=50></td><td width=30% valign=top align=right><select name="topuptype" id="select">
<option value="1">Aera Topup Code</option>
<option value="2">DiGi Topup Code</option>
</select>
  <input type=submit name=topup value="Top-up Now" id="topup"><td width=20% valign=top align=right>
  </tr>
  <?php
  if ($gmuser >= 5)
  {
  	echo "<tr>"; 
	echo "<td width=30% valign=top align=right>Topup Amount (coin): </td> <td width=50% colspan=2 valign=top align=left><input type=text name=topupamount value=0 size=50></td>"; 
  	echo "</tr>";
	echo "<td width=30% valign=top align=right>Topup Price (RM): </td> <td width=50% colspan=2 valign=top align=left><input type=text name=topupprice value=0 size=50></td>"; 
  	echo "</tr>";

  	echo "<tr>"; 
	echo "<td width=30% valign=top align=right>Topup from User name : </td> <td width=50% colspan=2 valign=top align=left><select name=topupbyuid><option value=0 selected>-</option>";

	$topupquser = mysql_query("SELECT * FROM users");
	if ($topupquser)
	{
		while ($topupruser = mysql_fetch_array($topupquser))
		{
			echo "<option value=".$topupruser["ID"].">".$topupruser["ID"]." - ".$topupruser["name"]."</option>";
		}
	}
  	echo "</select></td></tr>";
	
	echo "<tr>"; 
	echo "<td width=30% valign=top align=right>Topup to User name : </td> <td width=50% colspan=2 valign=top align=left><select name=topupuid><option value=0 selected>-</option>";

	$topupquser = mysql_query("SELECT * FROM users");
	if ($topupquser)
	{
		while ($topupruser = mysql_fetch_array($topupquser))
		{
			echo "<option value=".$topupruser["ID"].">".$topupruser["ID"]." - ".$topupruser["name"]."</option>";
		}
	}
  	echo "</select> <select name=topupuid2><option value=0 selected>-</option>";

	$topupquser2 = mysql_query("SELECT * FROM users ORDER BY name ASC");
	if ($topupquser2)
	{
		while ($topupruser2 = mysql_fetch_array($topupquser2))
		{
			echo "<option value=".$topupruser2["ID"].">".$topupruser2["name"]." (".$topupruser2["ID"].")</option>";
		}
	}
  	echo "</select></td></tr>";
  	echo "<tr>"; 
	echo "<td width=30% valign=top align=right>Topup Group: </td> <td width=50% colspan=2 valign=top align=left><select name=topupgroup>";
	echo "<option value=A selected>A - Normal Aeracode</option>"; 
	echo "<option value=B>B - Banned Aeracode</option>"; 
	echo "<option value=C>C - Reserved Aeracode</option>"; 
	echo "<option value=D>D - Locked Aeracode</option>"; 
	echo "<option value=E>E - Purchased with real Money</option>"; 
	echo "<option value=X>X - E-mail validation succeed</option>"; 
	echo "</select>"; 
	echo "</td>"; 
  	echo "</tr>";
  	echo "<tr>"; 
	echo "<td width=30% valign=top align=right>Topup BanMessage : </td> <td width=50% colspan=2 valign=top align=left><input type=text name=topupmsg size=50></td>"; 
  	echo "</tr>";
  	echo "<tr>"; 
	echo "<td width=30% valign=top align=right></td> <td width=50% valign=top align=left></td><td width=20% valign=top align=right><input type=submit name=topup value=Add id=topup> <input type=submit name=topup value=\"Add All\" id=topup></td>"; 
  	echo "</tr>";
  }
  ?>
</form>
<hr>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5%" align="left" valign="top"><strong>No.</strong></td>
    <td width="60%" align="left" valign="top"><strong>ID</strong></td>
    <td width="20%" align="left" valign="top"><strong>Cash</strong></td>
    <td width="10%" align="left" valign="top"><strong>Transaction Details</strong></td>
    <td width="5%" align="left" valign="top"><strong>Status</strong></td>
  </tr>

<?php
	$apnum = 1;
	if ($gmuser >= 5)
	{
		$apsearchby = 1;
	}
	else
	{
		$apsearchby = "bid";
	}
	//die(aerapointSearch($apsearchby, $chkid));
	$apquery = mysql_query(aerapointSearch($apsearchby, $chkid));
	if ($apquery)
	{
		$startnum = 0;
		$defaultlimit = 20;
		$limit = $defaultlimit;
		if (isset($_REQUEST[start]))
		{
			$startnum = $_REQUEST[start];
			$limit = $limit+$startnum;
		}
		while ($aprow = mysql_fetch_array($apquery))
		{
			if ($apnum >= $startnum)
			{
				echo "<tr>";
				echo "<td width=5% align=left valign=top>".$apnum."</td>";
				if ($gmuser >= 5)
				{
					echo "<td width=60% align=left valign=top>SERIAL: <a href=?op=accounts&type=manager&mgr=topupmgr&mode=Edit&tid=".$aprow["cid"].">".$aprow["serial"]."</a><BR>CODE: ".$aprow["code"]."<BR>Purchased Date: ".mdate($aprow["ctime"])."</td>";
				}
				else
				{
					echo "<td width=60% align=left valign=top>SERIAL: ".$aprow["serial"]."<BR>CODE: ".$aprow["code"]."<BR>Purchased Date: ".mdate($aprow["ctime"])."</td>";
				}
				echo "<td width=20% align=left valign=top>".$aprow["cash"]." Aera-coin<BR>Price: RM".$aprow["payment"]."</td>";
				echo "<td width=10% align=left valign=top>FROM: <a href=?op=accounts&type=vinfo&tid=".$aprow["cby"].">".getusername($aprow["cby"])."</a><BR>TO: <a href=?op=accounts&type=vinfo&tid=".$aprow["bid"].">".getusername($aprow["bid"])."</a></td>";
				echo "<td width=5% align=left valign=top>".getapstatus($aprow["status"])."</td>";
				echo "</tr>";
				$startnum++;
				if ($startnum >= $limit)
				{
					break;
				}
			}
			$apnum++;
		}
		if ($apnum == 1)
		{
			echo "<tr>";
			echo "<td align=center colspan=7>There is no any Aerapoint yet in history.</td>";
			echo "</tr>";
		}
	}
?>
</table>
<?php
	if ($startnum > $defaultlimit)
	{
		$xstartnum = $startnum-($defaultlimit*2);
		if ($xstartnum < 0)
			$xstartnum = 1;
		echo "<a href=?op=accounts&type=topup&start=$xstartnum>BACK</a> ";
	}
	else
		echo "BACK ";
	if ($startnum >= $limit)
	{
		$limit++;
		echo "| <a href=?op=accounts&type=topup&start=$limit>NEXT</a>";
	}
	else
		echo "| NEXT";

?>
<hr>