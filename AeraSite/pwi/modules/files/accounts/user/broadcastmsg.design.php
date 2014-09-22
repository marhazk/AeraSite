<table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="30%" align="right" valign="top">ID :</td>
      <td width="70%" align="left" valign="top"><input name="bid" type="text" id="bid" size="50" value="<?php echo $_POST["bid"];?>"/></td>
    </tr>
    <tr>
      <td width="30%" align="right" valign="top">Broadcast Message :</td>
      <td width="70%" align="left" valign="top"><p>
        <textarea name="bmsg" cols="50" rows="10" id="bmsg"><?php echo $_POST["bmsg"];?></textarea><BR /><BR />[<a href="?op=accounts&type=broadcast">CLICK HERE TO USE ONLIVE BROADCASTING SYSTEM</a>]
      </p>
</td>
    </tr>

  </table>
