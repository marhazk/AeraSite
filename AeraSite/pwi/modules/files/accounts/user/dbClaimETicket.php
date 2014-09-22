<?php
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT * FROM roles WHERE userid='$chkid' ORDER BY name ASC");
	$roles = $DB[roles]->retrieve();
	if ($uWeb_vinfo[eticket] > 1)
	{
		$DB[items] = new GameDBD();
		$DB[items]->connect("items", "SELECT * FROM itemlist WHERE iid='".$uWeb_vinfo[eticket]."'");
		$item = $DB[items]->searchBy("iid",$uWeb_vinfo[eticket]);
		$_eticket = $uWeb_vinfo[etickettotal]." E-Ticket (".$item[iname].")";
		$_eticketmap = '<img src="images/maps/map'.$item[iid].'.jpg">';
	}
	else
	{
		$_eticket = "No E-Ticket Available";
	}
	$resultQuery = "Please choose any of your character to register e-Ticket to the particular character through MailBox";
	$resultQuery2 = "Please choose any of your character to register e-Ticket to the particular character through MailBox";
	$success = false;
	if (($_POST[opchk] == "Register Now!") || ($_REQUEST[rid] >= 32))
	{
		$rid = $_REQUEST[rid];
		$RoleInfo = $DB[roles]->searchBy("roleid",$rid);
		if ($uWeb_vinfo[eticket] >= 1)
		{
			$DB[rolescur] = new GameDBD();
			$DB[rolescur]->connect("roles", "SELECT * FROM roles WHERE userid='".$chkid."'");
			$rolescur = $DB[rolescur]->retrieve();
			$_successMsg = "E-Ticket under this account has been sent into ".$RoleInfo[name]."\'s MailBox.";
			$_successMsg2 = "E-Ticket under this account has been sent into ".$RoleInfo[name]."'s MailBox. Wait for 1 minute to retrieve it.";
			$coinSql = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('$chkid', '".$RoleInfo[roleid]."', '0', '".$uWeb_vinfo[eticket]."', '".$uWeb_vinfo[etickettotal]."', '".$uWeb_vinfo[etickettotal]."', 'PW:Aera E-Ticketing System', '$_successMsg', '0', '0', '0', '', NOW());";
			$coinQuery = mysql_query($coinSql);
			$coinSql2 = "UPDATE users SET eticket=0,etickettotal=0 WHERE ID='$chkid'";
			$coinQuery2 = mysql_query($coinSql2);
			
			if (($coinQuery) && ($coinQuery2))
			{
				$resultQuery = $_successMsg;
				$resultQuery2 = $_successMsg2;
				$_eticket = "No ETicket Available (You have claimed)";
			}
			else if ($gmuser)
				$resultQuery = "Fail to Register! Contact GM for assistances.<BR>".$coinSql;
			else
				$resultQuery = "Fail to Register! Contact GM for assistances.";
		}
		else
			$resultQuery2 = "Fail to Register! GM has not announced the ETicket yet or you already claimed the E-Ticket. Please be patient.";
	}
?>
<center><p></p>
<h1>PWAera  Event > Register for Event Ticket (ETicket) / Claim Gift</h1>

<?php if (strlen($_eticketmap) > 1) { ?>
<P><?php echo $_eticketmap;?></P>
<?php } ?>
<?php if (strlen($resultQuery2) > 1) { ?>
<script>alert("<?php echo $resultQuery2; ?>");</script>
<?php } ?>

<p><?php echo $resultQuery2; ?></p>
<h1>Unclaimed Event Tickets/Gifts: <?php echo $_eticket; ?></h1>
<p><i>Note: How to register Horse Race Event? Just register for the ticket, then the ticket will transfer into your mailbox depending on your character you below. Note that event for Tour City of the Plume Ticket is located at (286, 384), Tour Etherblade Ticket (419, 872) and Tour City of the Lost Ticket (259, 619). Race will started once GM has announced the event.</i></p>
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
            <input type="submit" name="opchk" value="Register Now!" id="opchk" />
          </div></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</center>