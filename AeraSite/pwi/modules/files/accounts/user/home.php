<table width="100%" border="0">
  <tr>
    <td width="35%" align="right" valign="top"><strong>Your Promotion ID</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["ID"];?></td>
  </tr><tr>
    <td width="35%" align="right" valign="top"><strong>Access Level</strong></td>
    <td width="5%" align="center" valign="top"><strong> :</strong></td>
    <td width="60%" align="left" valign="top"><?php echo getaccstat($gmuser);?></td>
  </tr><tr>
    <td width="35%" align="right" valign="top"><strong>Unclaimed Account AeraGold (UAA)</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo (((int)($uWeb_vinfo["claimaeracoin"]) + ((int)($uWeb_vinfo["forumbal"])*2) )/100);?> AeraGold (Including Forum Rewards: <?php echo ((int)($uWeb_vinfo["forumbal"])*2);?> AeraCoin) <BR /><form method=post action="?op=accounts&type=ClaimUAA"><input type=submit name=opchk value="Claim Now!!"></form></td>
  </tr><tr>
    <td width="35%" align="right" valign="top"><strong>Unclaimed Event Ticket (E-Ticket) or PWAera Gift</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo ((int)($uWeb_vinfo["etickettotal"]));?> E-Ticket<BR /><form method=post action="?op=accounts&type=ClaimETicket"><input type=submit name=opchk value="Get E-Ticket!!"></form></td>
  </tr><tr>
    <td width="35%" align="right" valign="top"><strong>E-Mail Address</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["email"];?> 
    <?php
	if ($uWeb_vinfo["regsuccess"] == 1)
		echo "[VALIDATED]";
	else if ($uWeb_vinfo["regsuccess"] == 2)
	{
		echo "[UNVALIDATED]";
		?>
	  <form method=post action="?op=accounts&type=validate&email=<?php echo $uWeb_vinfo["email"];?>"><input type=Submit name=opchk value="Resend Validation Code"></form>
	<?php }
	else
		echo "[UNVALIDATED]";
	?>
    </td>
  </tr>
  <tr>
    <td width="35%" align="right" valign="top"><strong>First Name</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["fname"];?></td>
  </tr><tr>
    <td width="35%" align="right" valign="top"><strong>Last Name</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["lname"];?></td>
    </tr><tr>
    <td width="35%" align="right" valign="top"><strong>ID Number</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["idnumber"];?></td>
    </tr><tr>
    <td width="35%" align="right" valign="top"><strong>City</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["city"];?></td>
    </tr><tr>
    <td width="35%" align="right" valign="top"><strong>State</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["state"];?></td>
    </tr>
    <tr>
      <td width="35%" align="right" valign="top"><strong>Country</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td>
    <td width="60%" align="left" valign="top"><?php echo $uWeb_vinfo["province"];?></td>
  </tr>
    <tr>
      <td width="35%" align="right" valign="top"><strong>Your Mentor/Game Promoter</strong></td>
    <td width="5%" align="center" valign="top"><strong>:</strong></td><td width="60%" align="left" valign="top"><?php echo getusername($uWeb_vinfo["mentorid"]);?></td>
  </tr>
</table>