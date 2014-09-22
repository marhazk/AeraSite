<?php
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT * FROM roles WHERE userid='$chkid' ORDER BY name ASC");
	$roles = $DB[roles]->retrieve();
	$resultQuery = "Please choose any of your character to claim";
	$resultQuery2 = "";
	$success = false;
	if (($_POST[opchk] == "Claim Now!") || ($_REQUEST[rid] >= 32))
	{
		$rid = $_REQUEST[rid];
		$RoleInfo = $DB[roles]->searchBy("roleid",$rid);
		if ($RoleInfo[claimaeracoin] >= 1)
		{
			$DB[users] = new GameDBD();
			$DB[users]->connect("roles", "SELECT * FROM users WHERE ID='".$RoleInfo[userid]."'");
			$DB[rolescur] = new GameDBD();
			$_aeragold = ((int)($RoleInfo[claimaeracoin])/100)." AeraGold";
			$_successMsg = $_aeragold." under ".$RoleInfo[name]." has been sent into ".$RoleInfo[name]."\'s MailBox.";
			$_successMsg2 = $_aeragold." under ".$RoleInfo[name]." has been sent into ".$RoleInfo[name]."'s MailBox. Wait for 1 minute to retrieve it.";
			$coinSql = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('$chkid', '".$RoleInfo[roleid]."', '0', '16161', '".$RoleInfo[claimaeracoin]."', '".$RoleInfo[claimaeracoin]."', 'PW:Aera AeraGold System', '$_successMsg', '0', '0', '0', '', NOW());";
			$coinQuery = mysql_query($coinSql);
			$coinSql2 = "UPDATE roles SET claimaeracoin=0 WHERE roleid='".$RoleInfo[roleid]."'";
			$coinQuery2 = mysql_query($coinSql2);
			
			if ($coinQuery)
			{
				$resultQuery = $_successMsg;
				$resultQuery2 = $_successMsg2;
				$_aeragold = "0 AeraGold";
			}
			else if ($gmuser)
				$resultQuery = "Fail to Claim! Contact GM for assistances.<BR>".$coinSql;
			else
				$resultQuery = "Fail to Claim! Contact GM for assistances.";
		}
		else
			$resultQuery2 = "Fail to Claim! You dont have atleast 1 AeraCoin under this character.";
	}
?>
<center><p></p><h1>Claim AeraGold > Unclaimed Character AeraGold (UCA)</h1>
<?php if (strlen($resultQuery2) > 1) { ?>
<script>alert("<?php echo $resultQuery2; ?>");</script>
<?php } ?>

<p><?php echo $resultQuery2; ?></p>
<p><i>Note: How to increase your Unclaimed Character AeraGold (UCA)? Go to PK Zone Spot 1 or PK Zone Spot 2 to get one. The longer you stay, the many Unclaimed Character AeraGold (UCA) you will get.</i></p>
<table align="center" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
  <tr>
    <th colspan="4" bgcolor="#000000"><b><font color="#ffffff">Character List</font></b></th>
  </tr>
  <tr>
    <td width="100%" align="center"><form method="post" name="form1" id="form1">
      <table  cellpadding="0" cellspacing="0">
        <tr>
          <td width="30%"><span id="result_box" lang="en" xml:lang="en">Enter the character name</span>:</td>
          <td width="70%"><select name="rid" id="rid">
          <option value="0">-</option>
          <?php
		  
			$DB[rolescur] = new GameDBD();
			$DB[rolescur]->connect("roles", "SELECT * FROM roles WHERE userid='".$RoleInfo[userid]."'");
			$rolescur = $DB[rolescur]->retrieve();
		  	foreach ($roles as $role)
			{
				$_aeragold = ((int)($role[claimaeracoin])/100)." AeraGold";
		  ?>
          <option value="<?php echo $role[roleid]?>">Total of Collected AeraGold : <?php echo $_aeragold;?> (<?php echo $role[name]?>)</option>
          <?php } ?>
          </select>
          
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><div style="text-align: left;">
            <input type="submit" name="opchk" value="Claim Now!" id="opchk" />
          </div></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</center>