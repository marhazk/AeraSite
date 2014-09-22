<?php
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles", "SELECT * FROM roles ORDER BY roleid ASC");
	$roles = $DB[roles]->retrieve();
	$DB[itemlist] = new GameDBD();
	$DB[itemlist]->connect("itemlist", "SELECT * FROM itemlist WHERE (iname NOT LIKE '%N/A%' AND iname NOT LIKE '%Without Name%') ORDER BY iname ASC");
	$itemlist = $DB[itemlist]->retrieve();
	$DB[roles2] = new GameDBD();
	$DB[roles2]->connect("roles", "SELECT * FROM roles ORDER BY name ASC");
	$roles2 = $DB[roles2]->retrieve();
	$resultQuery = "Please fill in the blank below";
	if ($_POST[opchk] == "Send Item")
	{
		if ($gmuser)
		{
			if (strlen($_POST[rid]) >= 2)
				$rid = $_POST[rid];
			else if ($_POST[rid2] >= 1)
				$rid = $_POST[rid2];
			else
				$rid = $_POST[rid3];
				
			if (strlen($_POST[iid]) >= 2)
				$iid = $_POST[iid];
			else
				$iid = $_POST[iid2];
			$role = $DB[roles]->searchBy("roleid",$rid);
			$resultQuery = "";
			$itemDB = explode(":", $iid);
			foreach ($itemDB as $val)
			{
				$itemsql = "INSERT INTO uwebitems (userid, roleid, status, iid, icount, imaxcount, sender, msg, iproctype, iexpiredate, imask, idata, isdate) VALUES ('".$role[userid]."', '".$role[roleid]."', '0', '".$val."', '".$_POST[icount]."', '".$_POST[imaxcount]."', '".$_POST[sender]."', '".$_POST[msg]."', '".$_POST[iproctype]."', '".$_POST[iexpiredate]."', '".$_POST[imask]."', '".$_POST[idata]."', NOW());";
				$itemQuery = mysql_query($itemsql);
				if ($itemQuery)
					$resultQuery .= "The item ".$val." has been successfully sent to ".$role[name]."<BR>";
				else
					$resultQuery .= "The item ".$val." has not been sent to ".$role[name]."<BR>";
			}
		}
		else
			$resultQuery = "You are not Game Master. Only GM is allowed to use this session.";
	}
?>
<script type="text/javascript">
function addItem()
{
	var e = document.getElementById("iid2");
	var f = document.getElementById("iid");
	var strNewItem = e.options[e.selectedIndex].value;
	var strItem = f.value;
	if (strItem == "")
	{
		f.value = strNewItem;
	}
	else
	{
		f.value = strItem + ":" + strNewItem;
	}
};
</script>
<center>
<p><?php echo $resultQuery; ?></p>
<table align="center" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
  <tr>
    <th colspan="4" bgcolor="#000000"><b><font color="#ffffff">Send items for a particular character:</font></b></th>
  </tr>
  <tr>
    <td width="100%" align="center"><form method="post" name="form1" id="form1">
      <table  cellpadding="0" cellspacing="0">
        <tr>
          <td width="30%"><span id="result_box" lang="en" xml:lang="en">Enter the ID of the character</span>:</td>
          <td width="70%"><input type="text" name="rid" size="30" maxlength="10" value="<?php echo $rid;?>" class="text_field"/><BR /><select name="rid2" id="rid2">
          <option value="0">-</option>
          <?php
		  	foreach ($roles as $role)
			{
		  ?>
          <option value="<?php echo $role[roleid]?>"><?php echo $role[name]?></option>
          <?php } ?>
          </select><BR /><select name="rid3" id="rid2">
          <option value="0">-</option>
          <?php
		  	foreach ($roles2 as $role)
			{
		  ?>
          <option value="<?php echo $role[roleid]?>"><?php echo $role[name]?></option>
          <?php } ?>
          </select></td>
        </tr>
        <tr>
          <td>Item ID:</td>
          <td><input type="text" name="iid" id="iid" value="" size="30" class="text_field" /><BR /><select name="iid2" id="iid2">
          <option value="0">-</option>
          <?php
		  
		  	foreach ($itemlist as $item)
			{
				if ($item[iid] == $iid) {
		  ?>
          <option selected value="<?php echo $item[iid]?>"><?php echo $item[iname]?></option>
          <?php } else { ?>
          <option value="<?php echo $item[iid]?>"><?php echo $item[iname]?></option>
          <?php } } ?>
          </select>
            <span style="text-align: left;">
            <input type="button" name="add" value="Add Item" id="add" onclick="addItem();"/>
            </span></td>
        </tr>
        <tr>
          <!--<tr>
          <td>The position of item:</td>
          <td>
			<input type="text" name="ipos" value="0" size="16" class="text_field" />
		  </td>
        </tr>-->
        </tr>
        <tr>
          <td>Number of items:</td>
          <td><input type="text" name="icount" value="1" size="30" class="text_field" onfocus="form1.imaxcount.value=form1.icount.value;"  onchange="form1.imaxcount.value=form1.icount.value;" onkeypress="form1.imaxcount.value=form1.icount.value;" onblur="form1.imaxcount.value=form1.icount.value;"/></td>
        </tr>
        <tr>
          <td>Maximum # of:</td>
          <td><input type="text" name="imaxcount" value="1" size="30" class="text_field" /></td>
        </tr>
        <tr>
          <td>octets:</td>
          <td><input type="text" name="idata" value="" size="30" class="text_field" /></td>
        </tr>
        <tr>
          <td>Proctype:</td>
          <td><input type="text" name="iproctype" value="0" size="30" class="text_field" /></td>
        </tr>
        <tr>
          <td>Date of Expiry:</td>
          <td><input type="text" name="iexpiredate" value="0" size="30" class="text_field" /></td>
        </tr>
        <tr></tr>
        <tr>
          <td>(Weapon) Mask:</td>
          <td>1 (<span id="result_box3" lang="en" xml:lang="en"> Weapons </span>)</td>
        </tr>
        <tr>
          <td>(Armor) Mask:</td>
          <td>2 (<span id="result_box2" lang="en" xml:lang="en"> Head </span>), 8 (Capa), 16 (<span id="result_box4" lang="en" xml:lang="en"> Chest </span>), 64 (<span id="result_box5" lang="en" xml:lang="en"> Legs </span>), 128 (<span id="result_box6" lang="en" xml:lang="en"> Tennis </span>), 256 (<span id="result_box7" lang="en" xml:lang="en"> Boots</span>)</td>
        </tr>
        <tr>
          <td>(Jewelry) Mask:</td>
          <td>4 (<span id="result_box8" lang="en" xml:lang="en"> Paste</span>), 32 (<span id="result_box9" lang="en" xml:lang="en"> Belt </span>), 1536 (<span id="result_box10" lang="en" xml:lang="en"> Ring </span>)</td>
        </tr>
        <tr></tr>
        <tr>
          <td>(Coke) Mask:</td>
          <td> 2048 (<span id="result_box11" lang="en" xml:lang="en"> Arrows </span>) 131 072 (<span id="result_box12" lang="en" xml:lang="en"> Gadget </span>), 262144 (<span id="result_box13" lang="en" xml:lang="en"> Books </span>) 524 288 (<span id="result_box14" lang="en" xml:lang="en"> emoticons </span>) </td>
        </tr>
        <tr></tr>
        <tr>
          <td>(Hirki / Flight) Mask:</td>
          <td> 4096 (<span id="result_box15" lang="en" xml:lang="en">flight</span>), 1048576 (HP), 2,097,152 (MP) </td>
        </tr>
        <tr>
          <td>Mask:</td>
          <td><input type="text" name="imask" value="0" size="30" class="text_field" /></td>
        </tr>
        <tr>
          <td>Title of the letter:</td>
          <td><input type="text" name="sender" value="Item" size="30" class="text_field" id="sender" /></td>
        </tr>
        <tr>
          <td>Message:</td>
          <td><input type="text" name="msg" value="Item has been sent" size="30" class="text_field" id="msg" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><div style="text-align: left;">
            <input type="submit" name="opchk" value="Send Item" id="opchk" />
          </div></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>

<?php
	$gid = $_REQUEST["gid"];
	$DB[users] = new GameDBD();
	$DB[users]->connect("users");
	$DB[istatus] = new GameDBD();
	$DB[istatus]->connect("itemstatus");
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles");
	$DB[items] = new GameDBD();
	$DB[items]->connect("uwebitems");
?>
<h1>TOP 100 MAILED CHARACTERS</h1>
<table width="100%%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$sortBy = $_REQUEST["sort"];
	if ($sortBy == "")
		$sortBy = "giveid";
	$sortlink = '<a href="?op=common/character&sort=__value__">__value2__</a>';
	$DB[items]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			order=>"$sortBy desc",
			limit=>100,
			displayID=>true
		), 
		array(
			userid=>array(
				db=>$DB[users],
				attr=>"ID",
				displayAttr=>"name",
				name=>"User Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=accounts&type=RoleInfo&uid=__userid__">__value__</a>'
			),
			roleid=>array(
				db=>$DB[roles],
				attr=>"roleid",
				displayAttr=>"name",
				name=>"Character Name",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'<a href="?op=accounts&type=RoleInfo&rid=__roleid__">__value__</a>'
			),
			status=>array(
				db=>$DB[istatus],
				attr=>"isd",
				displayAttr=>"isname",
				name=>"Status",
				allowsort=>true,
				sortlink=>$sortlink
			),
			iid=>array(
				db=>$DB[itemlist],
				attr=>"iid",
				displayAttr=>"iname",
				name=>"Item Detail",
				allowsort=>true,
				sortlink=>$sortlink,
				links=>'__iid__ (__value__)'
			),
			icount=>"Total",
			isdate=>"Date of Sent"
		)
	);
?>
</table>

</center>
