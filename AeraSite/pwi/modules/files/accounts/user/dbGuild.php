<?php

		
	$DB[roles] = new GameDBD();
	$DB[roles]->connect("roles");
	$DB[cities] = new GameDBD();
	$DB[cities]->connect("cities");
	$DB[factions] = new GameDBD();
	$DB[factions]->connect("factions");
	$DB[factionusers] = new GameDBD();
	$DB[factionusers]->connect("factionusers");
	$DB[factionusers]->merge("rid", $DB[roles], "roleid");
	$DB[factionusers]->merge("fid", $DB[factions], "fid");
	$roleDB = $DB[factionusers]->retrieveBy(array("userid","==",$chkid));
	//echo $roleDB[0][name].":".$roleDB[0][fid].":".$roleDB[0][fname].":".$roleDB[0][masterid].":";
	$gmaster = false;
	foreach ($roleDB as $data)
	{
		if ($data[masterid] == $data[roleid])
		{
			$gid = $data[fid];
			$gmaster = true;
			$GuildDB = $DB[factions]->retrieveBy(array("fid","==",$gid));
		}
	}
	if ($gmaster)
	{
		$guildMsg = "";
		if ($_POST[opchk] == "Add Enemy Guild")
		{
			$qSQL = "INSERT into factionenemies (cfid, ctid, datetime) VALUES ($gid, ".$_POST[gList1].", NOW());";
		}
		else if ($_POST[opchk] == "Remove Enemy Guild")
		{
			$qSQL = "DELETE FROM factionenemies WHERE (cfid=$gid AND ctid=".$_POST[gList2].");";
		}
		else if ($_POST[opchk] == "Add Ally Guild")
		{
			$qSQL = "INSERT into factionallies (cfid, ctid, datetime) VALUES ($gid, ".$_POST[gList3].", NOW());";
		}
		else if ($_POST[opchk] == "Remove Ally Guild")
		{
			$qSQL = "DELETE FROM factionallies WHERE (cfid=$gid AND ctid=".$_POST[gList4].");";
		}
		if (strlen($_POST[opchk]) > 1)
		{
			$gQuery = mysql_query($qSQL);
			if ($gQuery)
				$guildMsg = "Your guild has been successfully updated";
			else
				$guildMsg = "Error: Fail to add/remove the guild. Please retry";
		}
		$DB[factionenemies] = new GameDBD();
		$DB[factionenemies]->connect("factionenemies", "SELECT cfid, ctid, ctid AS cid, ctid AS eid1, ctid AS eid2, ctid AS eid3 FROM factionenemies WHERE cfid=$gid");
		$DB[factionallies] = new GameDBD();
		$DB[factionallies]->connect("factionallies", "SELECT cfid, ctid, ctid AS cid, ctid AS aid1, ctid AS aid2, ctid AS aid3 FROM factionallies WHERE cfid=$gid");
		
		$DB[factionenemies]->merge("ctid", $DB[factions], "fid");
		$DB[factionallies]->merge("ctid", $DB[factions], "fid");

		$enemyDB = $DB[factionenemies]->retrieve();
		$allyDB = $DB[factionallies]->retrieve();
		$enemyAdd = $DB[factions]->retrieveBy(array("fid","!=",array(cid, $enemyDB)), "AND");
		$allyAdd = $DB[factions]->retrieveBy(array("fid","!=",array(cid, $allyDB)), "AND");
		//$nonDB = $DB[factions]->retrieveBy(array("fid","!=",array(cid, $enemyDB)), "AND");
		
		
		if (strlen($guildMsg) >= 1)
		{
?>
<script>alert('<?php echo $guildMsg; ?>');</script>
<p><?php echo $guildMsg; ?></p>
<?php } ?>
<h1>Guild Enemy List</h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[factionenemies]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			"order"=>"member_size desc",
			"displayID"=>true
		), 
		array(
			"fname"=>array(
				name=>"Guild Name",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
				),
			"flevel"=>"Level",
			"masterid"=>array(
				db=>$DB[roles],
				attr=>"roleid",
				displayAttr=>"name",
				name=>"Guild Master",
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			"member_size"=>"Guild Members"
		)
	);
?>
</table>
<form name="form1" method="post" action="">
  <select name="gList1" id="gList1">
<?php
if (is_array($enemyAdd))
	foreach ($enemyAdd as $val)
	{
		$display = true;
		if ($val[fid] == $gid)
			continue;
		if (is_array($allyDB))
			foreach ($allyDB as $xval)
				if ($xval[fname] == $val[fname])
				{
					$display = false;
					break;
				}
		if ($display)
			echo '<option value="'.$val["fid"].'">'.$val["fname"].'</option>';
	}
?>
  </select>
  <input type="submit" name="opchk" id="opchk" value="Add Enemy Guild">

  <select name="gList2" id="gList2">
    <?php
if (is_array($enemyDB))
	foreach ($enemyDB as $val)
	{
		if ($val[fid] == $gid)
			continue;
		echo '<option value="'.$val["fid"].'">'.$val["fname"].'</option>';
	}
?>
  </select>
  <input type="submit" name="opchk" id="opchk" value="Remove Enemy Guild" />
</form>
<h1>Guild Ally List</h1>
<table width="100%" bgcolor="#FFFFFF" border="1" cellpadding="3" cellspacing="0" >
<?php
	//foreach ($DB[guild]->retrieve() as $row)
	//{
	//	$num++;
	//
	$DB[factionallies]->printRows("<tr><td>","</td><td>","</td></tr>",
		array(
			"order"=>"member_size desc",
			"displayID"=>true
		), 
		array(
			"fname"=>array(
				name=>"Guild Name",
				links=>'<a href="?op=common/faction&gid=__fid__">__value__</a>'
				),
			"flevel"=>"Level",
			"masterid"=>array(
				db=>$DB[roles],
				attr=>"roleid",
				displayAttr=>"name",
				name=>"Guild Master",
				links=>'<a href="?op=common/character&rid=__roleid__">__value__</a>'
			),
			"member_size"=>"Guild Members"
		)
	);
?>
</table>

<form name="form1" method="post" action="">
  <select name="gList3" id="gList3">
<?php
if (is_array($allyAdd))
	foreach ($allyAdd as $val)
	{
		$display = true;
		if ($val[fid] == $gid)
			continue;
		if (is_array($enemyDB))
			foreach ($enemyDB as $xval)
			{
				if ($xval[fname] == $val[fname])
				{
					$display = false;
					break;
				}
			}
		if ($display)
			echo '<option value="'.$val["fid"].'">'.$val["fname"].'</option>';
	}
?>
  </select>
  <input type="submit" name="opchk" id="opchk" value="Add Ally Guild">
  <select name="gList4" id="gList4">
    <?php
if (is_array($allyDB))
	foreach ($allyDB as $val)
	{
		if ($val[fid] == $gid)
			continue;
		echo '<option value="'.$val["fid"].'">'.$val["fname"].'</option>';
	}
?>
  </select>
  <input type="submit" name="opchk" id="opchk" value="Remove Ally Guild" />
</form>
<?php
	} else {
		
?>
<script>alert('ERROR: You dont have any guild! Please make one guild to access this page.');</script>
<p>ERROR: You dont have any guild! Please make one guild to access this page.</p>
<?php } ?>