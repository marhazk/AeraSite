<?php
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT * FROM roles WHERE userid='$chkid' ORDER BY name ASC");
	$roles = $DB[roles]->retrieve();
	$_aeragold = (((int)($uWeb_vinfo["claimaeracoin"]) + ((int)($uWeb_vinfo["forumbal"])*2) )/100)." AeraGold (Including Forum Rewards: ".((int)($uWeb_vinfo["forumbal"])*2)." AeraCoin)";
	$resultQuery = "Please choose any of your character to transfer your account AeraCoin to the particular character through MailBox";
	$resultQuery2 = "Please choose any of your character to transfer your account AeraCoin to the particular character through MailBox";
	$success = false;
	if (($_POST[opchk] == "Transfer Now!") || ($_REQUEST[rid] >= 32))
	{
		$rid = $_REQUEST[rid];
		$RoleInfo = $DB[roles]->searchBy("roleid",$rid);
		if ($uWeb_vinfo[claimaeracoin] >= 1)
		{
			$DB[rolescur] = new GameDBD();
			$DB[rolescur]->connect("roles", "SELECT * FROM roles WHERE userid='".$chkid."'");
			$rolescur = $DB[rolescur]->retrieve();
			$_aeragold = (((int)($uWeb_vinfo["claimaeracoin"]) + ((int)($uWeb_vinfo["forumbal"])*2) )/100)." AeraGold (Including Forum Rewards: ".((int)($uWeb_vinfo["forumbal"])*2)." AeraCoin)";
			$_successMsg = $_aeragold." under this account has been sent into ".$RoleInfo[name]."\'s MailBox.";
			$_successMsg2 = $_aeragold." under this account has been sent into ".$RoleInfo[name]."'s MailBox. Wait for 1 minute to retrieve it.";
			$coinSql = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('$chkid', '".$RoleInfo[roleid]."', '0', '16161', '".(((int)($uWeb_vinfo["claimaeracoin"]) + ((int)($uWeb_vinfo["forumbal"])*2) ))."', '".(((int)($uWeb_vinfo["claimaeracoin"]) + ((int)($uWeb_vinfo["forumbal"])*2) ))."', 'PW:Aera AeraGold System', '$_successMsg', '0', '0', '0', '', NOW());";
			$coinQuery = mysql_query($coinSql);
			$coinSql2 = "UPDATE users SET claimaeracoin=0, forumclaimed=(forumclaimed+forumbal), forumbal=0 WHERE ID='$chkid'";
			$coinQuery2 = mysql_query($coinSql2);
			
			if (($coinQuery) && ($coinQuery2))
			{
				$resultQuery = $_successMsg;
				$resultQuery2 = $_successMsg2;
				$_aeragold = "0 AeraGold";
			}
			else if ($gmuser)
				$resultQuery = "Fail to Transfer! Contact GM for assistances.<BR>".$coinSql;
			else
				$resultQuery = "Fail to Transfer! Contact GM for assistances.";
		}
		else
			$resultQuery2 = "Fail to Claim! You dont have atleast 1 AeraCoin under this account.";
	}
?>
<center><p></p><h1>Claim AeraGold > Unclaimed Account AeraGold (UAA)</h1>
<?php if (strlen($resultQuery2) > 1) { ?>
<script>alert("<?php echo $resultQuery2; ?>");</script>
<?php } ?>

<p><?php echo $resultQuery2; ?></p>
<h1>Unclaimed Account AeraGold : <?php echo $_aeragold; ?></h1>
<p><i>Note: How to increase your Unclaimed Account AeraGold? Just login to any your character in PWAera game. The longer you online, the many Unclaimed Account AeraGold (UAA) you will get.</i></p>
<table align="center" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
  <tr>
    <th colspan="4" bgcolor="#000000"><b><font color="#ffffff">Character List</font></b></th>
  </tr>
  <tr>
    <td width="100%" align="center"><form method="post" name="form1" id="form1">
      <table  cellpadding="0" cellspacing="0">
        <tr>
          <td width="30%"><span id="result_box" lang="en" xml:lang="en">MailBox to</span>:</td>
          <td width="70%"><select name="rid" id="rid">
          <option value="0">-</option>
          <?php
		  	foreach ($roles as $role)
			{
		  ?>
          <option value="<?php echo $role[roleid]?>"><?php echo $role[name]?></option>
          <?php } ?>
          </select>
          
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><div style="text-align: left;">
            <input type="submit" name="opchk" value="Transfer Now!" id="opchk" />
          </div></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</center>