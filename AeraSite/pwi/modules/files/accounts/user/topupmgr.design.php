
  <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40%" align="right" valign="top">Topup ID : </td>
      <td width="60%" align="left" valign="top"><input name="cid" type="text" id="cid" value="<?php echo $_POST[cid];?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Created Date :</td>
      <td align="left" valign="top"><input name="ctime" type="text" id="cid11" value="<?php echo $_POST[ctime];?>"> 
      Current: <?php echo mdate($_POST[ctime]);?></td>
    </tr>
    <tr>
      <td width="40%" align="right" valign="top">Processed Date :</td>
      <td width="60%" align="left" valign="top"><input name="btime" type="text" id="btime" value="<?php echo $_POST[btime];?>">
      Current: <?php echo mdate($_POST[btime]);?></td>
    </tr>
    <tr>
      <td width="40%" align="right" valign="top">Creator ID :</td>
      <td width="60%" align="left" valign="top"><select name="cby"><?php echo getlist("users", "ID", $_POST[cby], array("ID", "name"), "", "ID DESC");?></select></td>
    </tr>
    <tr>
      <td width="40%" align="right" valign="top">Purchaser ID :</td>
      <td width="60%" align="left" valign="top"><select name="bid"><?php echo getlist("users", "ID", $_POST[bid], array("ID", "name"), "", "ID DESC");?></select></td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top">Serial :</td>
      <td align="left" valign="top"><input name="serial" type="text" id="cid9" value="<?php echo $_POST[serial];?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Top-Up Code :</td>
      <td align="left" valign="top"><input name="code" type="text" id="cid10" value="<?php echo $_POST[code];?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top">Aerapoint (Aeracoin): </td>
      <td align="left" valign="top"><input name="cash" type="text" id="cash" value="<?php echo $_POST[cash];?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Amount (RM) :</td>
      <td align="left" valign="top"><input name="payment" type="text" id="payment" value="<?php echo $_POST[payment];?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Status :</td>
      <td align="left" valign="top"><input name="status" type="text" id="status" value="<?php echo $_POST[status];?>"></td>
    </tr>
    <tr>
      <td width="40%" align="right" valign="top">Group :</td>
      <td width="60%" align="left" valign="top"><input name="cgroup" type="text" id="cgroup" value="<?php echo $_POST[cgroup];?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Description :</td>
      <td align="left" valign="top"><input name="banreason" type="text" id="banreason" value="<?php echo $_POST[banreason];?>"></td>
    </tr>
  </table>
